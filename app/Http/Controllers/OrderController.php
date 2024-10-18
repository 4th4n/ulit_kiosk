<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $order = session()->get('order', []);
        
        return view('kiosk.index', compact('items', 'order'));
    }

    public function addToOrder(Request $request)
    {
        $item = Item::find($request->item_id);

        // Get current order from session
        $order = session()->get('order', []);

        // Add item or update quantity
        if(isset($order[$item->id])) {
            $order[$item->id]['quantity']++;
        } else {
            $order[$item->id] = [
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => 1
            ];
        }

        session()->put('order', $order);

        return redirect()->back()->with('success', 'Item added to order.');
    }

    public function removeFromOrder(Request $request)
    {
        $order = session()->get('order');

        if(isset($order[$request->item_id])) {
            unset($order[$request->item_id]);
            session()->put('order', $order);
        }

        return redirect()->back()->with('success', 'Item removed from order.');
    }

    public function checkout()
    {
        $order = session()->get('order');

        if (!$order) {
            return redirect()->back()->with('error', 'Order is empty!');
        }

        $totalPrice = 0;
        foreach($order as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // Save order to database
        $newOrder = Order::create(['total_price' => $totalPrice]);

        foreach ($order as $itemId => $details) {
            OrderItem::create([
                'order_id' => $newOrder->id,
                'item_id' => $itemId,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('order');
        return redirect()->route('orders.view')->with('success', 'Order placed successfully!');
    }

    public function viewOrders()
    {
        $orders = Order::with('items')->get();
        return view('admin.orders', compact('orders'));
    }
}
