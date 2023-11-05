@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  <div class="mb-3">
                    <h3>ORDER ID : {{ $order->id }}</h3>
                    <span><strong>BY : </strong> {{ $order->user->name }}</span><br>

                    @if ($order->payment_receipt == null && $order->is_paid == false)
                        <strong>Status : </strong> Unpaid
                    @elseif($order->payment_receipt !=null && $order->is_paid == false)
                        <strong>Status : </strong> <span>Paid - Pending</span>
                    @elseif($order->payment_receipt != null && $order->is_paid == true)
                        <strong>Status : </strong> <span>Paid - Confirmed</span>
                    @endif
                    <hr>
                    @php
                        $total_price = 0;
                    @endphp
                    @foreach ($order->transactions as $transaction)
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="mb-3">
                            <span class="fw-bolder">Product : </span>
                            <span>{{ $transaction->product->name }}</span><br>
                            <span class="fw-bolder"> Amount : </span>
                            <span>{{ $transaction->amount }} pcs</span><br>
                            <span><Strong>Price : </Strong>@rupiah($transaction->product->price)</span><br>
                          </div>
                          <hr>
                          <span><Strong>Total : </Strong>@rupiah($transaction->product->price * $transaction->amount)</span>
                        </div>
                      </div>
                      @php
                        $total_price += $transaction->product->price * $transaction->amount;    
                      @endphp
                    @endforeach
                        <hr>
                        <h3>Total Price : @rupiah($total_price)</h3>
                        <hr>
                </div>
                <div class="mb3">
                  @if(!Auth::user()->is_admin)
                    @if ($order->is_paid == false && $order->payment_receipt == null)
                        <form action="{{ route('order.payment', $order) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <label class="form-label">Payment receipt</label>
                          <input type="file" name="payment_receipt" class="form-control" required><br>
                          <button class="btn btn-success" type="submit">Submit Payment</button>

                        </form>
                    @endif
                  @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection