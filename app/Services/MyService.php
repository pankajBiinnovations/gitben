<?php

namespace App\Services;
use DB;
use App\Rules\Upper;
use Validator;
use Illuminate\Http\Request;
class MyService
{
    public function doSomething(Request $request)
    {
        
        $request->validate( [
            'name' => ['required', new Upper]
           
        ]);
      DB::table('users')->insert([
        'name'=>'pankaj singh',
        'email'=>'pankaj@gmail.com',
       ]);
    }
}
