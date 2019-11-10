<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateCategoryFormRequest;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class CategoryController extends Controller
{
    private $repository;
    private $totalPage = 15;


    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
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

            $categories = $this->repository->paginate($this->totalPage);

            return View::make('admin.categories.partials.table', compact('categories'))->render();
        }

        $categories = $this->repository->paginate($this->totalPage);

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
        $dataForm = $request->only('title', 'description');

        if (!$this->repository->store($dataForm)) {
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
        if (!$category = $this->repository->findById($id)) {
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
        if (!$category = $this->repository->findById($id)) {
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
        $dataForm = $request->only('title', 'description');

        if (!$this->repository->update($id, $dataForm)) {
            return redirect()->route('categories.edit', $id)
                ->with(['errors' => 'Falha ao editar']);
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
        if (!$category = $this->repository->findById($id)) {
            return redirect()->back();
        }

        $this->repository->delete($id);

        return redirect()->route('categories.index')
            ->with('success', "Registro [{$category->id} -  {$category->title}] excluido com sucesso!");;
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');

        $categories = $this->repository->search($data);

        return View::make('admin.categories.partials.table', compact('categories'))->render();
    }
}
