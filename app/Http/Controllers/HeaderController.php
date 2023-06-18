<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function showHeader()
    {
        $categories = Category::with('subcategories')->paginate(2);

        return view('header', compact('categories'));
    }
}

