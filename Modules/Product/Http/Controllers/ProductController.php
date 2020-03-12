<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Subcategory\Entities\Subcategory;
use Illuminate\Support\Facades\Storage;
use Rest;
use Illuminate\Http\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $subcategory = Subcategory::all();
        
        return view('product::create', ['subcategory'=>$subcategory]);
    }

    public function edit($id)
    { 
        $product = Product::findOrFail($id);
        $subcategory = Subcategory::all();
        return view('product::edit', ['product' => $product, 'subcategory' => $subcategory]);

    }

    public function data(Request $request){

        $result = Product::getDatatable($request->all());

        $data = array();
        $total = count($result);
        
        foreach ($result as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] = (strlen($value->description)<70)?$value->description:substr($value->description,0, 70).'...';
            $row[] = $value->price;
            $row[] = $value->subcategory_name;
            $row[] = '<button class="btn btn-warning" onClick="location.href ='."'".url('/admin/product/edit').'/'.$value->id."'".'"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteCategory('.$value->id.')"><i class="fa fa-trash"></i></button>';
        
            $data[] = $row;

        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            "recordsFiltered"=> $total]);;
    }
    
    public function update(Request $request, $id){
       
            request()->validate($this->fieldRules());
          
            $data = $request->all();

            if($request->file('image')){
                $fileName = md5(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('product_image', $request->file('image'),$fileName);
                // Storage::putFileAs('product_image', $request->file('image'), $fileName);
                $data['image'] = "/storage/product_image/$fileName";
    
            }
            
                
            if($request->file('sample_file')){
                $fileName = md5(uniqid()).'.'.$request->file('sample_file')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sample_file', $request->file('sample_file'),$fileName);
                // Storage::putFileAs('product_image', $request->file('image'), $fileName);
                $data['sample_file'] = "/storage/sample_file/$fileName";

            }
            $product = Product::findOrFail($id);
            $product->update($data);
        
            
            return redirect('/admin/product/index')
                            ->with('success','Product updated successfully');
    }

    public function store(Request $request){
        request()->validate($this->fieldRules());
    
        $data = $request->all();
        if($request->file('image')){
            $fileName = md5(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('product_image', $request->file('image'),$fileName);
            // Storage::putFileAs('product_image', $request->file('image'), $fileName);
            $data['image'] = "/storage/product_image/$fileName";

        }
        
        if($request->file('sample_file')){
            $fileName = md5(uniqid()).'.'.$request->file('sample_file')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('sample_file', $request->file('sample_file'),$fileName);
            // Storage::putFileAs('product_image', $request->file('image'), $fileName);
            $data['sample_file'] = "/storage/sample_file/$fileName";

        }
        
        Product::create($data);
    
        return redirect('/admin/product/index')
                        ->with('success','Product created successfully');

    }

    public function get($id){
       
        try{
            $Product = Product::findOrFail($id);
            
            return Rest::success('success', $Product);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $Product = Product::findOrFail($id);
            $Product->delete();
            $filename = str_replace("/storage",'', $Product->image);
            Storage::disk('public')->delete($filename);
            
            return Rest::success('Product is deleted');

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }


    private function fieldRules(){
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'subcategory_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
    
}
