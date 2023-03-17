<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlogs()
    {
        return Blog::all();
    }

    public function getSingleBlog(Blog $blog)
    {

        $singleBlog = Blog::find($blog);
        return $singleBlog;
    }

    public function createBlog(Request $request)
    {
        $blog = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog['user_id'] = auth()->id();
        return Blog::create($blog);
    }

    public function deleteBlog(Blog $blog)
    {
        return Blog::destroy($blog->id);
    }

    public function updateBlog(Request $request,Blog $blog)
    {
        $blog = Blog::find($blog->id);
        $blog->update($request->all());
        return $blog;
    }
}
