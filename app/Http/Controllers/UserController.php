<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class UserController extends BaseController
{
    public $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->userService->registerUser(
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        return response()->json(['message' => 'User registered successfully']);
    }
    public function form()
    {
        return view('form');
    }
}
