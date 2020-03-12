<?php

namespace OneStop;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['name', 'status'];

    public function subcategory()
    {
        return $this->hasMany('Modules\Subcategory\Entities\Subcategory');
    }

    public static function getDatatable($requestArray)
    {
        $sort_by = $requestArray['order'][0]['column'];
        $sort_dir = $requestArray['order'][0]['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        

        $query = DB::table('category');
        if($keyword){
            $query = $query->where('category.name', 'like',"%$keyword%");
    
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('name', $sort_dir);
        
        } elseif($sort_by == 2){//status
            $query = $query->orderBy('status', $sort_dir);

        } 

        $query = $query->offset($start)->limit($length);

        return $query->get();
        

    }
}
