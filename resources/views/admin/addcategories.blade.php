

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
      <div class=" mb-3">
      <form method="POST" action="{{ route('admin.storecategory') }}">
    @csrf <!-- CSRF token for protection -->

    <div class="mb-3 col-6">
        <label for="category_name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="name" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
   
      </div>
    </div>
  </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection
