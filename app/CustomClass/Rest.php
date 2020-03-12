<?php
namespace OneStop\CustomClass;

use Illuminate\Http\Response;

class Rest
{

    public static function token()
    {
        return csrf_token();
    }


    public static function validationFail($errors)
    {
        $response = [ 
            'code'=> $code, 
            'status'=>'Error', 
            'message'=>$errors->toArray()
        ];
       
        return response()->json($response,400);
    }

    public static function error($message = 'Error', $code = 500){
        $response = [ 
            'code'=> $code, 
            'status'=>'Error', 
            'message'=>$message
        ];

        return response()->json($response, $code);
    }
        
    public static function success($message,$data = null, $code=200){
        $response = [ 
            'code'=> $code, 
            'status'=>'Success', 
            'message'=>$message,
            'data' => $data
        ];

        return response()->json($response, $code);

    }

}
