<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryControler extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(CategoryRequest $request)
    {

        try {
            $validated = $request->validated();
            $categories = new Category();
            $categories->name = $request->name;
            $categories->save();
            toastr()->success('تم اضافة القسم بنجاح');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    } //end of edit

    public function update(CategoryRequest $request)
    {

        try {
            $validated = $request->validated();
            $categories = Category::findOrFail($request->id);
            $categories->update($request->all());
            toastr()->success(trans('تم التعديل بنجاح'));
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update


    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id)->delete();
        toastr()->error(trans('تم الحذف بنجاح'));
        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $categories = Category::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();


        return view(
            'dashboard.categories.index',
            compact('categories')
        );
    }
}