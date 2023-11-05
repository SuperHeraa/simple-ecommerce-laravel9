@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chart') }}</div>
                @php
                    $total_price = 0;
                @endphp
                <div class="card-body">
                    @foreach ($carts as $cart)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="{{ url('storage/'. $cart->product->image) }}" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{ $cart->product->name }}</h5>
                              <p class="card-text">Price : {{ $cart->product->price }}</p>
                              <form action="{{ route('cart.edit', $cart) }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="input-group mb-3">
                                    <input class="form-control" type="number" name="amount" aria-describedby="basic-addonz" value={{ $cart->amount }}>
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-outline-secondary">Edit</button>
                                    </div>
                                  </div>
                              </form>
                              <p class="card-text">Total : @rupiah($cart->product->price * $cart->amount)</p>
                                <form action="{{ route('cart.delete', $cart) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form> 
                            </div>
                          </div>
                        </div>
                      </div>
                      @php
                          $total_price += $cart->product->price * $cart->amount;
                      @endphp
                    @endforeach
                    <hr>
                        <h2>Total Price : @rupiah($total_price)</h2>
                    <hr>
                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm mt-2 w-100" @if($carts->isEmpty()) disabled @endif>Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection