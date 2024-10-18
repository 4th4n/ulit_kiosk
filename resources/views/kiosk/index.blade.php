@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kiosk Ordering System</h1>
    <div class="row">
        <div class="col-md-8">
            <h2>Menu</h2>
            <div class="row">
                @foreach($items as $item)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>{{ $item->name }}</h5>
                            <p>Price: ₱{{ number_format($item->price, 2) }}</p>
                            <form action="{{ route('order.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary">Add to Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h2>Your Order</h2>
            @if(session('order'))
            <ul class="list-group mb-3">
                @foreach(session('order') as $id => $details)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <h6>{{ $details['name'] }}</h6>
                        <small>Qty: {{ $details['quantity'] }}</small>
                    </div>
                    <span>₱{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                    <form action="{{ route('order.remove') }}" method="POST" class="ml-3">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </li>
                @endforeach
            </ul>
            <a href="{{ route('order.checkout') }}" class="btn btn-success btn-block">Checkout</a>
            @else
            <p>Your order is empty.</p>
            @endif
        </div>
    </div>
</div>
@endsection
