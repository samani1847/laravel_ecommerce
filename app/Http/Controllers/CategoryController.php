<?php

namespace OneStop\Http\Controllers;

use Illuminate\Http\Request;
use OneStop\Category;
use Validator, Rest;

class CategoryController extends Controller
{

    public function index(){
        
      return view('category');
                 
    }

    public function data(Request $request){
   
        $category = Category::getDatatable($request->all());
        $data = array();
        $total = count($category);
        
        foreach ($category as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] = ($value->status == 1)? '<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>';
            $row[] = '<button class="btn btn-warning" onClick="edit('.$value->id.')"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteCategory('.$value->id.')"><i class="fa fa-trash"></i></button>';
            $data[] = $row;

        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            "recordsFiltered"=> $total]);;
    }

    public function getData(Request $request){
        
        return Rest::success('Success', Category::all());        
    }

    public function getDetail(Request $request, $id){
        try{
            $category = Category::findOrFail($id);            
            return Rest::success('Success', $category);
        } catch(Exception $e){
            return Rest::error("Error get category");
        }
        
    }
    public function update(Request $request, $id){
       
        $validator = Validator::make($request->all(), $this->fieldRules());
       
        if ($validator->fails()) {
            
            return Rest::error('Invalid Parameters');
        }

        try{
            $category = Category::findOrFail($id);
            $category->update($request->all());    
            return Rest::success('Category updated successfully');

        }catch(Exception $e){
            return Rest::error('Error saving category');
        }

    }
    public function updateData(Request $request, $id){
       
        $validator = Validator::make($request->all(), $this->fieldRules());
       
        if ($validator->fails()) {
            
            return Rest::error('Invalid Parameters');
        }

        try{
            $category = Category::findOrFail($id);
            $category->update($request->all());    
            return Rest::success('Category updated successfully', Category::all());

        }catch(Exception $e){
            return Rest::error('Error saving category');
        }

    }
    
    public function save(Request $request){
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
            $category = new Category;
             $category->create($request->all());    
             return Rest::success('Category updated successfully', Category::all());
 
         }catch(Exception $e){
             return Rest::error('Error saving category');
         }
    }

    public function deleteData($id){
        
        try{
            $category = Category::findOrFail($id);
            $category->delete();

            return Rest::success('Category is deleted', Category::all());

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }

    
    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->fieldRules());
        
         if ($validator->fails()) {
             
             return Rest::error('Invalid Parameters');
         }
 
         try{
            $category = new Category;
             $category->create($request->all());    
             return Rest::success('Category updated successfully');
 
         }catch(Exception $e){
             return Rest::error('Error saving category');
         }
    }

    public function get($id){
       
        try{
            $category = Category::findOrFail($id);
            return Rest::success('success', $category);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $category = Category::findOrFail($id);
            $category->delete();

            return Rest::success('Category is deleted');

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
