@extends('welcome')

@section('content')
<div class="container">
    <div class="row my-3 align-items-center">
        <div class="col-12">
            <h4 class="mb-3">Category Tree</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {!! renderCategories($categories) !!}
        </div>
    </div>
</div>
@endsection
