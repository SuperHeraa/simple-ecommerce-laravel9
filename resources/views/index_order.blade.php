@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>

                <div class="card-body">
                  @foreach ($orders as $order)
                      <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <h5><strong><a href="{{ route('order.show', $order) }}">ORDER ID : {{ $order->id }}</a></strong></h5>
                                <span>By : {{ $order->user->name }}</span>
                                @if ($order->is_paid == false && $order->payment_receipt == null)
                                    <p>Unpaid</p>
                                @elseif($order->is_paid == false && $order->payment_receipt != null)
                                    <p>Paid - Pending</p>
                                @elseif($order->is_paid == true && $order->payment_receipt != null)
                                    <p>Paid - Confirmed</p>
                                @endif
                            </div>
                            @if ($order->payment_receipt != null)
                              <div class="d-flex justify-content-start">
                                <a class="btn btn-warning me-2" href="#showPayment{{ $order->id }}" data-bs-toggle="modal">Show payment receipt</a>
                                @if ($order->is_paid == true && $order->payment_receipt != null)
                                    <button class="btn btn-success" disabled>Success</button>
                                @elseif(Auth::user()->is_admin)
                                  <form action="{{ route('order.confirm', $order) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Confirm</button>
                                  </form>
                                @endif
                              </div>
                            @endif
                        </div>
                      </div>
                        <!-- Modal -->
                  <div class="modal fade" id="showPayment{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img src="{{ url('storage/'.$order->payment_receipt) }}" class="rounded mx-auto d-block img-thumbnail" width="500">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cart</title>
  </head>
  <body>
    <div class="container">
        <div class="mb-3">
            <h1>Order List</h1>
        </div>
      <div class="mb-3">
       @foreach ($orders as $order)
           <p>ID : {{ $order->id }}</p>
           <p>User : {{ $order->user->name }}</p>
           <p>Created at : {{ $order->created_at }}</p>
       @endforeach
       <div class="mt-3">
      
          @if ($order->is_paid == false)
          <div class="mb-3">
            <span class="badge bg-warning text-dark">Pending</span>
            <a href="#showPayment" data-bs-toggle="modal">Show payment receipt</a>
          </div>
            <form action="{{ route('order.confirm', $order) }}" method="post">
              @csrf
              <button class="btn btn-primary" type="submit">Confirm</button>
            </form>
          @else
            <span class="badge bg-success">Paid</span>
          @endif

       </div>
      </div>
 
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html> --}}