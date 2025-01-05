<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Show the admin dashboard
    public function categories()
    {
        $categories = Category::all(); 
        return view('admin.categories', compact('categories'));
    }
    public function addcategories()
    {
        return view('admin.addcategories',);
    }
  
    

    public function storecategory(Request $request)
    {


        // Create a new category
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function destroy($id)
    {
        // Find the category by ID and delete it
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Category not found']);
    }
    public function edit($id)
    {
        $categories = Category::find($id); 
        return view('admin.editcategories', compact('categories'));
    }

    public function update(Request $request, $id)
{
    // Find the category by ID
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('admin.categories')->with('error', 'Category not found');
    }


    $category->name = $request->name;
    $category->save();

    return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
}

}
