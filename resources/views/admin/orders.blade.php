@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order History</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Total Price</th>
                <th>Items</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                        <li>{{ $item->name }} ({{ $item->pivot->quantity }} pcs)</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
