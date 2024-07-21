@extends('welcome')

@section('content')
<div class="row my-3 align-items-center">
  <div class="col-6 d-flex align-items-center">
      <h4 class="mb-0">categories</h4>
  </div>
  <div class="col-6 text-end">
      <a class="btn btn-primary" href="{{ url('parent_categories/add') }}">Add Parent Category</a>
  </div>
</div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Sub Category</th>
        <th scope="col">Created at</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($parent_categories as $key => $category)
        <tr>
          <td>{{ $key +1 }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ count($category->subCategories) }}</td>
          <td>{{ $category->created_at }}</td>
          <td>
            <a class="btn btn-primary" href="{{ url('parent_categories/edit?id=' . $category->id) }}">Edit</i></a>
            <a class="btn btn-primary ml-2" href="#" 
            onclick="deleteCategory('{{ url('parent_categories/delete') }}', '{{ $category->id }}', 'Are you sure you want to delete this parent category?', 'parent_category'); return false;">
             Delete
          </a>
        </tr>
      @empty
        <tr>
          <td colspan="14">
            <center>No Record available</center>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection