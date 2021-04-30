@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="text-center">Laravel Cache Practice by Redis</h1>
    <hr>
    <ul>
    @foreach ($products as $product)
        <li>{{ $loop->iteration }}</li>
        <li>{{ $product->category->name }}</li>
        <hr>
    @endforeach
    </ul>
</div>
@stop
