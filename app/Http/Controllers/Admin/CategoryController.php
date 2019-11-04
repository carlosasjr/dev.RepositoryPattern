<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class CategoryController extends Controller
{
    private $category;
    private $totalPage = 1;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataForm = $request->except('_token');

            if (isset($dataForm['title']) || isset($dataForm['url']) ||
                isset($dataForm['description']) || isset($dataForm['id'])) {
                return $this->search($request);
            }

            $categories = $this->category
                ->orderBy('id', 'desc')
                ->paginate($this->totalPage);

            return View::make('admin.categories.partials.table',compact('categories'))->render();
        }

        $categories = $this->category
                            ->orderBy('id', 'desc')
                            ->paginate($this->totalPage);

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

        return redirect()->route('categories.index')
                         ->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->find($id);

        if (!$category)
        {
            return redirect()->back();
        }

        return view('admin.categories.show', compact('category'));
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
        $category = $this->category->find($id);

        if (!$category)
        {
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', "Registro [{$category->id} -  {$category->title}] excluido com sucesso!");;
    }

    public function search(Request $request)
    {
        $dataForm = $request->all();

      /*  $categories = $this->category->where('title', 'like', "%{$search}%")
                                     ->orWhere('url', 'like', "%{$search}%")
                                     ->orWhere('description', 'like', "%{$search}%")
                                     ->paginate($this->totalPage);*/

         $categories = $this->category->where(function ($query) use ($dataForm) {
            if (isset($dataForm['id'])) {
                $query->where('id', $dataForm['id']);
            }

             if (isset($dataForm['title'])) {
                 $field = $dataForm['title'];
                 $query->orWhere('title', 'like', "%{$field}%" );
             }

             if (isset($dataForm['url'])) {
                 $field = $dataForm['url'];
                 $query->orWhere('url', 'like', "%{$field}%" );
             }

             if (isset($dataForm['description'])) {
                 $field = $dataForm['description'];
                 $query->orWhere('description', 'like', "%{$field}%" );
             }
         })->orderBy('id', 'desc')
           ->paginate($this->totalPage) ;

          return View::make('admin.categories.partials.table',compact('categories'))->render();
    }
}
