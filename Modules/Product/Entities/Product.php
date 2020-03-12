<?php

namespace Modules\Product\Entities;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use Searchable;

    protected $table = 'product';
    protected $fillable = ['name', 'price', 'subcategory_id', 'description', 'file','image', 'sample_file'];

    public static function getDatatable($requestArray)
    {
        $sort_by = $requestArray['order'][0]['column'];
        $sort_dir = $requestArray['order'][0]['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        

        $query = DB::table('product')
            ->leftJoin('subcategory', 'subcategory.id','=','product.subcategory_id')
            ->select('product.name','product.price','subcategory.name as subcategory_name', 'product.id', 'product.description');
        if($keyword){
            $query = $query->where('product.name', 'like',"%$keyword%");
            $query = $query->orWhere('description', 'like', "%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('product.id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('product.name', $sort_dir);
        
        } elseif($sort_by == 2){//description
            $query = $query->orderBy('product.description', $sort_dir);

        } elseif($sort_by == 3){//price
            $query = $query->orderBy('category.price', $sort_dir);

        } elseif($sort_by == 4){//subcategory name
            $query = $query->orderBy('subcategory.name', $sort_dir);

        }         

        $query = $query->offset($start)->limit($length);

        return $query->get();
        

    }

       /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'product_index';
    }

     /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}
