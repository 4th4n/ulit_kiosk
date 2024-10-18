<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ItemController;

Route::get('/', [OrderController::class, 'index'])->name('kiosk.index');
Route::post('/add-to-order', [OrderController::class, 'addToOrder'])->name('order.add');
Route::post('/remove-from-order', [OrderController::class, 'removeFromOrder'])->name('order.remove');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/orders/view', [OrderController::class, 'viewOrders'])->name('orders.view');



// Show the form to add a new item
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

// Store the newly created item
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('items', [ItemController::class, 'index'])->name('items.index');

Route::resource('items', ItemController::class);
