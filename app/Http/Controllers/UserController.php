<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
use App\Models\Blog;
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

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        // You can now access the user details using $user

        // Example: Retrieve user's email
        $email = $user->getEmail();

        // Implement your login or registration logic here

        return redirect('/home'); // Redirect to the desired page after authentication
    }

    public function related()
    {
        // $users = Post::withCount('comments')->get();
        $blogs = Blog::with('comments')->get();
        
        return view('users.index', compact('blogs'));
    }
}
