<?php

namespace Modules\Subcategory\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    protected $fillable = ['name', 'status', 'category_id'];

    
    public function category()
    {
        return $this->belongsTo('OneStop\Category',  'category_id');
    }

    public static function getDatatable($requestArray)
    {
        $sort_by = $requestArray['order'][0]['column'];
        $sort_dir = $requestArray['order'][0]['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        

        $query = DB::table('subcategory')
            ->leftJoin('category', 'subcategory.category_id','=','category.id')
            ->select('category.name as category_name', 'subcategory.id', 'subcategory.status', 'subcategory.name');
        if($keyword){
            $query = $query->where('category.name', 'like',"%$keyword%");
            $query = $query->orWhere('subcategory.name', 'like', "%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('subcategory.id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('subcategory.name', $sort_dir);
        
        } elseif($sort_by == 2){//status
            $query = $query->orderBy('subcategory.status', $sort_dir);

        } elseif($sort_by == 3){//category name
            $query = $query->orderBy('category.name', $sort_dir);

        } 

        $query = $query->offset($start)->limit($length);

        return $query->get();
        

    }

}
