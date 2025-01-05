<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.index', compact('users'));
    }

    // View all users
    public function updatestatus(Request $request,)
    {

   $userid =$request->userId;
   $user = User::find($userid);
   if ($user) {
    $user->status = $user->status == 1 ? 0 : 1;

    $user->save();

    return response()->json(['success' => true]);
}

// If the user is not found, return a failure response
return response()->json(['success' => false, 'message' => 'User not found']);
}
    

  
}
