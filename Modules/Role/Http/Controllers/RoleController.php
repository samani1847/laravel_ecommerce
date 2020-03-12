<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Rest;

class RoleController extends Controller
{
 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('role::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
       
        $permissions = Permission::all();
        return view('role::create', compact('permissions'));
    }

    public function edit($id)
    { 
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('role::edit', compact('role','permissions'));

    }

    public function data(Request $request){

        $result = $this->getDatatable($request);

        $data = array();
        $total = count($result);
        
        foreach ($result as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] =  $value->permissions()->pluck('name')->implode('<br>');
            $row[] = '<button class="btn btn-warning" onClick="location.href ='."'".url('/admin/role/edit').'/'.$value->id."'".'"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteRole('.$value->id.')"><i class="fa fa-trash"></i></button>';
        
            $data[] = $row;

        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            "recordsFiltered"=> $total]);
    }

    private function getDatatable(Request $request){
        
        $requestArray = $request->all();

        $sort_by = $requestArray['order'][0]['column'];
        $sort_dir = $requestArray['order'][0]['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        

        $query = Role::where('id', '<>', "");
        
        if($keyword){
            $query = $query->where('name', 'like',"%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('name', $sort_dir);
        
        } 

        $query = $query->offset($start)->limit($length);

        return $query->get();
        


    }
    
    public function update(Request $request, $id){
       
        
            request()->validate(['name' => 'required|unique:roles,name,'.$id.',id']);

            $role = Role::findOrFail($id);

            $data = $request->all();
            if(array_key_exists('permission', $data)){
                $permissions = $data['permission'];
                $role->syncPermissions($permissions);
                
            } else {
                $role->syncPermissions(array());
            }
            $role->update(['name' => $data['name']]);
        
            
            return redirect('/admin/role/index')
                            ->with('success','role updated successfully');
    }

    public function store(Request $request){
        request()->validate(['name' => 'required|unique:roles,name']);
        
        $data = $request->all();
        $role = Role::create(['name' => $data['name']]);
    
        if(array_key_exists('permission', $data)){
            $permissions = $data['permission'];
            $role->syncPermissions($permissions);     
            
        } else {
            $role->syncPermissions(array());
        }
       
        
        return redirect('/admin/role/index')
                        ->with('success','role created successfully');
       
    }

    public function get($id){
       
        try{
            $role = Role::findOrFail($id);
            
            return Rest::success('success', $role);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $role = Role::findOrFail($id);
            $role->delete();
       
            return Rest::success('role is deleted');

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }


    private function fieldRules(){
        return [
            'name' => 'required'
        ];
    }
  
}
