<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OneStop\User;
use Spatie\Permission\Models\Role;
use Rest;

class UserController extends Controller
{
 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
       
        $roles = Role::all();
        return view('user::create', compact('roles'));
    }

    public function edit($id)
    { 
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user::edit', compact('user','roles'));

    }

    public function data(Request $request){

        $result = $this->getDatatable($request);

        $data = array();
        $total = count($result);
        
        foreach ($result as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] = $value->email;
            $row[] =  $value->roles()->pluck('name')->implode('<br>');
            $row[] = '<button class="btn btn-warning" onClick="location.href ='."'".url('/admin/user/edit').'/'.$value->id."'".'"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteUser('.$value->id.')"><i class="fa fa-trash"></i></button>';
        
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
        

        $query = User::where('id', '<>', "");
        
        if($keyword){
            $query = $query->where('name', 'like',"%$keyword%");
            $query = $query->orWhere('email', 'like',"%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('name', $sort_dir);
        
        } elseif($sort_by == 2){ //name
            $query = $query->orderBy('email', $sort_dir);
        
        } 

        $query = $query->offset($start)->limit($length);

        return $query->get();
        


    }
    
    public function update(Request $request, $id){
       
            if($request->input('password')){
                request()->validate([ 
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id.',id',
                    'password'=>'required|min:6|confirmed']);
            
            } else {
                request()->validate([ 
                    'name'=>'required',
                    'email'=>'required|email|unique:users,email,'.$id.',id',
                    ]);
            
            }
         
            $user = User::findOrFail($id);

            $data = $request->all();
            if(array_key_exists('permission', $data)){
                $permissions = $data['permission'];
                $user->syncPermissions($permissions);
                
            } else {
                $user->syncPermissions(array());
            }

            $password = $data['password'] ? bcrypt($data['password']): $user->password;
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $password
                ]);
            
            $user->syncRoles([$data['role']]);
    
            
            return redirect('/admin/user/index')
                            ->with('success','user updated successfully');
    }

    public function store(Request $request){
        request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed']);
        
        
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
            ]);
        $user->syncRoles([$data['role']]);
      
        
        return redirect('/admin/user/index')
                        ->with('success','user created successfully');
       
    }

    public function get($id){
       
        try{
            $user = User::findOrFail($id);
            
            return Rest::success('success', $user);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $user = User::findOrFail($id);
            $user->delete();
       
            return Rest::success('user is deleted');

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
