<?php

namespace App\Http\Controllers;

use App\Models\Check;

use Illuminate\Support\Facades\Auth;
class CheckController extends Controller
{
   public function check(){
       $check=Check::where("email",Auth::user()->email)->first();
       if(!$check){
            $check=new Check();
            $check->email=Auth::user()->email;
            $check->count=1;
            $check->created_at=now();
            $check->save();
            
       }else{
            $check->count=$check->count+1;
            $check->created_at=now();
            $check->save();    
       }

       return response()->json(["count"=>$check->count]);
       
      
       
       
   }
}
