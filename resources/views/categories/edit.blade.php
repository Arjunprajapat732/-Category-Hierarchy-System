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
                    <option value="0">None</option>
                        {!! renderCategories($parent_categories) !!}
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
<script>
    select_value = '{{ $category->parent_id }}';
    window.onload = function() {
        document.getElementById('parent_category').value = select_value;
    };
</script>