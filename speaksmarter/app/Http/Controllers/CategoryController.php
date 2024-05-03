<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        define('NUMBER_OF_ITEMS_PER_PAGE',3);

        $categories = Category::paginate(NUMBER_OF_ITEMS_PER_PAGE);


        //inertia por defecto se posiciona en la carpeta resources/js/Pages
        return inertia('Categories/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */

     //CategoryRequest, la hicimos nosostros, para seguir prinicipios de SOLID y que solo se encarge de guardar, la validacion la hace el
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('Categories/Edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
