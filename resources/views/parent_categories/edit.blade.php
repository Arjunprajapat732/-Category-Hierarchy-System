@extends('welcome')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ url('parent_categories/store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $parent_category->id}}">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $parent_category->name }}" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
