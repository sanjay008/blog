

@extends('layouts.app')  

@section('content')
<div class="container mt-5">
<a class="btn btn-primary" href="{{ route('blog.myblog') }}" role="button">My Blog</a>

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
          <div class="user">
            <div class="user-info">
              <h5>{{$blog->user->first_name}}</h5>
              <small>{{ $blog->created_at->format('Y-m-d') }}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach


      </div>
   
   </div>
    </div>
@endsection
