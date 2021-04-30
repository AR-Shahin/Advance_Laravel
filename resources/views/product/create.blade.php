@extends('layouts.app')

@section('content')
<div class="container mt-3">
      <h1 class="text-center">Laravel Cache Practice by Redis</h1>
    <hr>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <select name="category_id" id="">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <input type="text" name="name">
        <br>
        <textarea name="text" id="" cols="30" rows="10"></textarea><br>
        <button type="submit">Submit</button>
    </form>
</div>
@stop
