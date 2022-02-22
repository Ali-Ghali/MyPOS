<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {
            $search = $request->input('search');
            return $q->where('name', 'LIKE', "%{$search}%");
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }


    public function store(ProductRequest $request)
    {



        try {
            $validated = $request->validated();
            $request_data = $request->all();

            if ($request->image) {

                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('Attachments/product_images/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();
            } //end of if

            Product::create($request_data);
            toastr()->success('تم اضافة المنتج بنجاح');
            return redirect()->route('products.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store


    public function show($id)
    {
        //
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));
    } //end of edit


    public function update(ProductUpdateRequest $request, Product $product)
    {

        try {
            $validated = $request->validated();

            $request_data = $request->all();

            if ($request->image) {

                if ($product->image != 'default.png') {

                    Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
                } //end of if

                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('Attachments/product_images/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();
            } //end of if

            $product->update($request_data);
            toastr()->success('تم تعديل المنتج بنجاح');
            return redirect()->route('products.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        } //end of if

        $product->delete();
        toastr()->error(trans('تم الحذف بنجاح'));
        return redirect()->route('products.index');
    } //end of destroy
}