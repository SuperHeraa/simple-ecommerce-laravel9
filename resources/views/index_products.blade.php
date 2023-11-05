@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>
                <div class="card-group m-auto">
                    @foreach ($products as $product)
                        <div class="card m-3" style="width: 18rem;">
                            <img class="card-img-top" src="{{ url('storage/' . $product->image) }}" alt="">
                            <div class="card-body">
                                <h5 class="card-text"><strong>{{ $product->name }}</strong></h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <a href="{{ route('product.detail', $product) }}" class="btn btn-primary" type="submit">Show Detail</a>
                                @if(Auth::check() && Auth::user()->is_admin)
                                    <a class="btn btn-danger" href="#confirmDelete{{ $product->id }}" data-bs-toggle="modal">Hapus</a>
                                @endif
                            </div>
                        </div> 
                        <!-- Modal -->
                        <div class="modal fade" id="confirmDelete{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are You Sure Delete This Item ?<br>
                                    Product : {{ $product->name }}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('product.delete', $product) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>                       
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
