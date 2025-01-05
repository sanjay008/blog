@extends('layouts.app')

<style>
    .blog-imges{
        width: 100px;
    }
</style>
@section('content')
    <div class="container ,t-5">
        <h1 class="mb-3">Edit Blog</h1>

        <!-- Form to create a blog -->
        <form action="{{ route('blog.updateblog', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{$blog->title}}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{$blog->description}}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-control" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" >
                <input type="hidden" name="ex_image" id="image" class="form-control" value="{{$blog->image}}">
                <img src="{{ asset($blog->image) }}" alt=" " class="blog-imges">
            </div>

            <button type="submit" class="btn btn-primary">Save Blog</button>
        </form>
    </div>
@endsection
