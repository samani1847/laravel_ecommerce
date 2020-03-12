<?php

namespace Modules\Subcategory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OneStop\Category;
use Modules\Subcategory\Entities\Subcategory;
use Validator, Rest, DB;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        $category = Category::all();

        return view('subcategory::index', ['category' => $category]);
    }

    public function data(Request $request){

        $result = Subcategory::getDatatable($request->all());

        $data = array();
        $total = count($result);
        
        foreach ($result as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] = ($value->status == 1)? '<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>';
            $row[] = $value->category_name;
            $row[] = '<button class="btn btn-warning" onClick="edit('.$value->id.')"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteCategory('.$value->id.')"><i class="fa fa-trash"></i></button>';
        
            $data[] = $row;

        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            "recordsFiltered"=> $total]);;
    }
    
    public function update(Request $request, $id){
       
        $validator = Validator::make($request->all(), $this->fieldRules());
       
        if ($validator->fails()) {
            
            return Rest::error('Invalid Parameters');
        }

        try{
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->update($request->all());    
            return Rest::success('Subcategory updated successfully');

        }catch(Exception $e){
            return Rest::error('Error saving category');
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
            $subcategory = new Subcategory;
             $subcategory->create($request->all());    
             return Rest::success('Subcategory updated successfully');
 
         }catch(Exception $e){
             return Rest::error('Error saving subcategory');
         }
    }

    public function get($id){
       
        try{
            $subcategory = Subcategory::findOrFail($id);
            
            return Rest::success('success', $subcategory);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->delete();

            return Rest::success('Subcategory is deleted');

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

