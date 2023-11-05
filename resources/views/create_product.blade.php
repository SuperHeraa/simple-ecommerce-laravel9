@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('product.store') }}" class="form-action" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input class="form-control" type="text" name="name" placeholder="product name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input class="form-control" type="text" name="price" placeholder="price">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input class="form-control" type="text" name="stock" placeholder="stock">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input class="form-control" type="text" name="description" placeholder="description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
