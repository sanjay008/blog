

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


    <div class="row">
      <div class="col-md-8 m-auto ">
      <div class="d-flex mb-3">
      <a class="btn btn-primary" href="{{ route('admin.addcategories') }}" role="button">Add Categories</a>

</div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @foreach ($categories as $categoriess)
                <tr>
                    <td>{{ $categoriess->id }}</td>
                    <td>{{ $categoriess->name }}</td>
                
                    <td>
                        <a href="{{route('admin.editcategory', ['id' => $categoriess->id])}}" class="text-primary" >Edit</a>
                        <a href="#" class ="delete-category text-danger" data-id="{{ $categoriess->id }}">Delet</a>
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
    // Event listener for delete button
    $('.delete-category').on('click', function() {
        var categoryId = $(this).data('id'); // Get the category ID from data-id attribute

        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: '/admin/deletcategory/' + categoryId, // The route defined in routes/web.php
                type: 'DELETE', // Send a DELETE request
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        alert('Category deleted successfully!');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Category could not be deleted.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    });
});

</script>


@endsection
