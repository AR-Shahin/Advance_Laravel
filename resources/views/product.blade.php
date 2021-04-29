@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <ul>
    @foreach ($products as $product)
        <li>{{ $product->category->name }}</li>
        <hr>
    @endforeach
    </ul>
</div>
@stop
