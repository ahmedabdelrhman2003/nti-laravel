@extends('dashboard.layout.parent')
@section('title', 'Add New Product')
@section('content')
    @include('dashboard.layout.include.message')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @csrf
        <div class="col-6">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        </div>
        <div class="form-row">
            {{-- @csrf --}}
            <div class="col-6">
                <label for="name">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="price">Price</label>
                <input type="number" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="Code">Code</label>
                <input type="number" name="code" value="{{ old('code') }}">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="brand">Brand name</label>
                <input type="text" name="brand" value="{{ old('brand') }}">
                @error('brand')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="image">image</label>
                <input type="file" name="image" value="{{ old('image') }}">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <label for="desc">Discribtion</label>
                <textarea name="desc" cols="30" rows="10">{{ old('desc') }}</textarea>
                @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary " style="text-align: center" name="page"
                value="index">create</button>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-dark " style="text-align: center" name="page"
                value="back">Submet&return</button>
        </div>
    </form>
@endsection
