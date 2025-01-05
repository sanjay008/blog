

@extends('layouts.app')  

@section('content')
<div id="admin-panel">
  <aside id="menu">
    <nav>
      <ul>
      
        <li>
          <a href="{{ route('admin.index') }}"><i class="fas fa-fw fa-users"></i> Users</a>
        </li>
        <li>
          <a href="{{ route('admin.categories') }}"><i class="fas fa-fw fa-users"></i> Categories</a>
        </li>
      </ul>
    </nav>
  </aside>
  <main id="content">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item" aria-current="page">Dashboard</li>
      </ol>
    </nav>

    <h1 class="page-title">User</h1>
    <div class="row">
      <div class="col-md-8 m-auto ">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">role</th>
      <th scope="col">active / Inactive</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->role }}</td>
                
                    <td>
        <!-- Using a unique ID for each checkbox based on user ID -->
        <input type="checkbox" hidden="hidden" id="{{ $user->id }}" {{ $user->status == 1 ? 'checked' : "" }} class="switch-checkbox">
        <label class="switch" for="{{ $user->id }}"></label>
    </td>
                    </td>
                </tr>
            @endforeach
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function() {
    $('.switch-checkbox').on('change', function() {
        var userId = $(this).attr('id');  
        console.log(userId);  // Log the userId to see if it's correct

        $.ajax({
            url: '/admin/updatestatus', 
            type: 'POST',
            data: {
                userId: userId,
                _token: $('meta[name="csrf-token"]').attr('content')  
            },
            success: function(response) {
              if (response.success) {
                    // Display success message in an alert
                    alert('User status updated successfully');
                } else {
                    // Display failure message in an alert
                    alert('Failed to update user status');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
@endsection
