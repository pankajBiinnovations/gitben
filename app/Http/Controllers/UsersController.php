<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Rules\Uppercase;
use Illuminate\Http\RedirectResponse;
use App\Services\MyService;
use DB;
class UsersController extends BaseController
{
   public function create()
   {
    return view('index');
   }
   public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', new Uppercase],
            'email' => 'required|email'
        ]);

        $user = User::create($validatedData);
                    
        return back();
    }
    public function loadMore(Request $request)
    {
        // Get the offset and limit from the request
        $offset = $request->get('offset');
        $limit = $request->get('limit');

        // Query the data from the database
        $data = User::offset($offset)->limit(2)->get();

        // Return the data as a JSON response
        return response()->json($data);
    }

    public function myMethod(MyService $myService)
    {
        $myService->doSomething();
       
        // Rest of your code...
    }
    public function edit($id)
    {
       
        $item = DB::table('users')->where('id',$id)->get(); // Assuming you have an "Item" model
    
        return view('edit', compact( 'item'));
    }
}
