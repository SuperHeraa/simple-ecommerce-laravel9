@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Product') }}</div>
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                      <div class="">
                          <img src="{{ url('storage/' . $product->image) }}" alt="..." width="200px">
                      </div>
                      <div class="">
                          <h1>{{ $product->name }}</h1>
                          <h6>{{ $product->description }}</h6>
                          <h3>@rupiah($product->price)</h3>
                          <hr>
                          <span>Stock {{ $product->stock }} left</span>
                          @if(!Auth::user()->is_admin)
                            <form action="{{ route('add_to_cart', $product) }}" method="post">
                              @csrf
                              <div class="input-group mb-3">
                                <input class="form-control" type="number" name="amount" aria-describedby="basic-addonz" value=1>
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-outline-secondary">Add to cart</button>
                                </div>
                              </div>
                            </form>
                          @else
                          <form action="{{ route('product.edit', $product) }}" method="get">
                              <button type="submit" class="btn btn-primary">Edit Product</button>
                          </form>
                          @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection