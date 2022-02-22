<?php

namespace App\Http\Controllers\Clients;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    } //end of create


    public function store(Request $request, Client $client)
    {
        try {
            $request->validate([
                'products' => 'required|array',
            ]);

            $this->attach_order($request, $client);

            toastr()->success('تم اضافة الطلب بنجاح');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store


    public function show($id)
    {
        //
    }

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    } //end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        try {
            $request->validate([
                'products' => 'required|array',
            ]);

            $this->detach_order($order);

            $this->attach_order($request, $client);

            toastr()->success('تم تعديل الطلب بنجاح');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy($id)
    {
        //
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);
        } //end of foreach

        $order->update([
            'total_price' => $total_price
        ]);
    }

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        } //end of for each

        $order->delete();
    } //end of detach order
}