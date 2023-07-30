@extends('dashboard.layout.parent')
@section('title', 'Edit Product')
@section('content')
    @include('dashboard.layout.include.message')
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="form-row">
            <div class="col-6">
                <label for="name">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="price">Price</label>
                <input type="number" name="price" value="{{ $product->price }}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="Code">Code</label>
                <input type="number" name="code" value="{{ $product->code }}">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="brand">Brand name</label>
                <input type="text" name="brand" value="{{ $product->brand }}">
                @error('brand')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="image">image</label>
                <input type="file" name="image" value="{{ $product->image }}">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <label for="desc">Discribtion</label>
                <textarea name="desc" cols="15" rows="5">{{ $product->desc }}</textarea>
                @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <img src="{{ url('dist/img/product/' . $product->image) }}" alt="{{ $product->name }}">
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary " style="text-align: center">Edit</button>
        </div>
    </form>
@endsection
