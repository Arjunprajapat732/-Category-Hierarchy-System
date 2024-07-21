@extends('welcome')

@section('content')
<div class="container">
    <div class="row my-3 align-items-center">
        <div class="col-12">
            <h4 class="mb-3">Category Tree</h4>
        </div>
    </div>

    @foreach($categories as $parent)
        <div class="mb-4">
            <h5>{{ $parent->name }}</h5>
            @if($parent->children->isNotEmpty())
                <ul class="list-group">
                    @foreach($parent->children as $category)
                        <li class="list-group-item">
                            {{ $category->name }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No subcategories available.</p>
            @endif
        </div>
    @endforeach
</div>
@endsection
