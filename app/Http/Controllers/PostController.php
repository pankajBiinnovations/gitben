<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
class PostController extends BaseController
{
public function index()
{
    $posts = Post::with('comments')->withCount('comments')->get();
    foreach($posts as $post){
        echo "Post Title    ".$post->name;echo "<br/>";
        echo "Number of comments        ".$post->comments_count;echo "<br/>";
    }
}    
}
