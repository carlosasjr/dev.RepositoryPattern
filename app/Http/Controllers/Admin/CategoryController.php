<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private $category;
    private $totalPage = 15;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param StoreUpdateCategoryFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->category->create($dataForm);

        if (!$insert) {
            return redirect()->route('categories.create');
        }

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);

        if (!$category)
        {
            return redirect()->back();
        }

        return view('admin.categories.create', compact('category'));
    }

    /**
     * @param StoreUpdateCategoryFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $dataForm = $request->all();

        $category = $this->category->find($id);

        $update = $category->update($dataForm);

        if (!$update) {
            return redirect()->route('categories.edit', $id)->with(['errors' => 'Falha ao editar']);
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
