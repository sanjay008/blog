<?php
namespace App\Http\Controllers;

use App\Models\Blog; // Include the Blog model
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Show the dashboard with all blogs
    public function index()
    {
        // Fetch all blogs from the database (you can customize the query as needed)
        $blogs = Blog::all(); 

        // Pass blogs to the dashboard view
        return view('dashboard', compact('blogs'));
    }
}

