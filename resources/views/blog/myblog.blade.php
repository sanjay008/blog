

@extends('layouts.app')  

@section('content')
<div class="container mt-5">
<a class="btn btn-primary" href="{{ route('dashboard') }}" role="button">All Blog</a>
<a class="btn btn-primary" href="{{ route('blog.addblog') }}" role="button">Add Blog</a>

</div>
    <div class="container  mt-5">

   <div class="row n">

   @foreach($blogs as $blog)
   
      <div class="card col-4 me-3">
        <div class="card-header">
          <img src="{{ asset($blog->image) }}" alt="" />
        </div>
        <div class="card-body">
          <span class="tag tag-teal">{{$blog->category->name}}</span>
          <h4>{{ $blog->title }}</h4>
          <p>
          {{ \Str::limit($blog->description, 400) }}
          </p>
          <div class="user d-flex justify-content-between">
            <div class="user-info ">
              <small>{{ $blog->created_at->format('Y-m-d') }}</small>
            </div>
            </div>
            <div class="user-info ">
            <a href="{{route('blog.editblog', ['id' => $blog->id])}}" class="text-primary" >Edit</a>
            <a href="#" class ="delete-blog text-danger" data-id="{{ $blog->id }}">Delet</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach


      </div>
   
   </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Event listener for delete button
    $('.delete-blog').on('click', function() {
        var blogId = $(this).data('id'); // Get the blog ID from data-id attribute

        if (confirm('Are you sure you want to delete this blog?')) {
            $.ajax({
                url: '/blog/deletblog/' + blogId, // The route defined in routes/web.php
                type: 'DELETE', // Send a DELETE request
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        alert('blog deleted successfully!');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('blog could not be deleted.');
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
