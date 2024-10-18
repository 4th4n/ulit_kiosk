<?php


namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // Method to show the form for creating a new item
    public function create()
    {
        return view('items.create');
    }
    
    // Method to store the newly created item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size of 2MB
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');

        // Image upload handling
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in 'storage/app/public/images'
            $item->image = $imagePath;
        }

        $item->save();

        return redirect()->route('items.create')->with('success', 'Item created successfully.');
    }
    public function show($id)
{
    $item = Item::find($id);

    if (!$item) {
        return redirect()->route('items.index')->with('error', 'Item not found.');
    }

    return view('items.show', compact('item'));
}
public function index()
{
    // Kunin ang lahat ng mga item mula sa database
    $items = Item::all();

    // I-render ang view kasama ang mga item
    return view('items.index', compact('items'));
}

public function destroy($id)
{
    // Hanapin ang item gamit ang ID
    $item = Item::findOrFail($id);

    // Tanggalin ang item
    $item->delete();

    // I-redirect pabalik sa item list na may success message
    return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
}



}


