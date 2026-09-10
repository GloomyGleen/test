<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required']
        ]);
        Category::create($request->all());
        $request->session()->flash('success', 'Категория добавлена');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required']
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        $request->session()->flash('success', 'Категория обновлена');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $category = Category::find($id);
        // $category->delete();

        // Category::destroy($id);
        // session()->flash('success', 'Категория удалена');

        $category = Category::find($id);
        if ($category->posts()->count()) { 
            return redirect()->route('categories.index')->with('error', 'У категории есть записи');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена');
    }
}