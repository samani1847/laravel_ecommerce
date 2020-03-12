<?php

namespace Modules\Voucher\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Voucher extends Model
{

    protected $table = 'voucher';
    protected $fillable = ['name', 'code', 'discount','max_claim','claimed', 'status','start_date', 'end_date'];

    public static function getDatatable($requestArray)
    {
        $sort_by = $requestArray['order'][0]['column'];
        $sort_dir = $requestArray['order'][0]['dir'];
        $keyword = $requestArray['search']['value'];
        $start = $requestArray['start'];
        $length = $requestArray['length'];
        

        $query = DB::table('voucher')
                  ->select('id','name','code','discount', 'max_claim', 'claimed', 'status', 'start_date', 'end_date');
        if($keyword){
            $query = $query->where('name', 'like',"%$keyword%");
            $query = $query->orWhere('code', 'like', "%$keyword%");
        }
        
        // id
        if($sort_by == 0){
            $query = $query->orderBy('id', $sort_dir);
        
        } elseif($sort_by == 1){ //name
            $query = $query->orderBy('name', $sort_dir);
        
        } elseif($sort_by == 2){//code
            $query = $query->orderBy('code', $sort_dir);

        } elseif($sort_by == 3){
            $query = $query->orderBy('discount', $sort_dir);

        } elseif($sort_by == 4){
            $query = $query->orderBy('max_claim', $sort_dir);

        } elseif($sort_by == 5){
            $query = $query->orderBy('claimed', $sort_dir);
       
        } elseif($sort_by == 6){
            $query = $query->orderBy('start_date', $sort_dir);
       
        } elseif($sort_by == 7){
            $query = $query->orderBy('end_date', $sort_dir);
       
        }         

        $query = $query->offset($start)->limit($length);

        return $query->get();
        

    }


    
}
