@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Product') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <form class="form-action" action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" name="price" value="{{ $product->price }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input class="form-control" type="text" name="stock" value="{{ $product->stock }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input class="form-control" type="text" name="description" value="{{ $product->description }}">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection