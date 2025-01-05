<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    // Show the form for creating a new blog
    public function index()
    {
        $categories = Category::all();  // Get all categories
        return view('blog.addblog', compact('categories'));
    }

    public function myblog()
    {
        // Fetch all blogs from the database (you can customize the query as needed)
        $blogs = Blog::where('user_id', Auth::id())->get(); 

        // Pass blogs to the dashboard view
        return view('blog.myblog', compact('blogs'));
    }
    // Store the new blog in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image upload
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'blogs/images/' . $image->getClientOriginalName();
            $image->move(public_path('blogs/images'), $imagePath);
        }

        // Create a new blog
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,  // Store the image path
            'user_id' => Auth::id(),  // Store the image path
        ]);

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }



    public function destroy($id)
    {
        // Find the category by ID and delete it
        $blog = Blog::find($id);

        if ($blog) {
            $blog->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'blog not found']);
    }

    public function edit($id)
    {
        $blog = Blog::find($id); 
        $categories = Category::all(); 
        return view('blog.editblog', compact('blog','categories'));
    }

    public function update(Request $request, $id)
    {
      
        $blog = Blog::find($id);
    
        if (!$blog) {
            return redirect()->route('blog.myblog')->with('error', 'blog not found');
        }
    
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'blogs/images/' . $image->getClientOriginalName();
            $image->move(public_path('blogs/images'), $imagePath);
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->image = $request->category_id;
        $blog->image = $request->hasFile('image') 
    ? $imagePath 
    : $request->ex_image;
        $blog->save();
    
        return redirect()->route('blog.myblog')->with('success', 'blog updated successfully!');
    }
}

