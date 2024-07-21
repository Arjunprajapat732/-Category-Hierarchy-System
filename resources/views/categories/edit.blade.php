@extends('welcome')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ url('categories/store') }}" method="POST">
            @csrf
            <br>
            <div class="form-group">
                <label for="parent_category">Parent Category</label>
                <select name="parent_id" id="parent_category" required class="form-control">
                    <option value="">None</option>
                    @foreach($parent_categories as $parent_category)
                        <option value="{{ $parent_category->id }}" {{ $parent_category->id == $category->parent_id ? 'selected' : '' }}>
                            {{ $parent_category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $category->id }}">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
