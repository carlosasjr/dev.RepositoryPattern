<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Category;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use function foo\func;

class ProductController extends Controller
{
    protected $repository;
    protected $totalPage = 15;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataForm = $request->except('_token');

            if (isset($dataForm['category_id']) || isset($dataForm['name']) || isset($dataForm['url']) ||
                isset($dataForm['description']) || isset($dataForm['id'])) {
                return $this->search($request);
            }

            $products = $this->repository
                             ->relationships('category')
                             ->orderBy('id')
                             ->paginate($this->totalPage);

            return View::make('admin.products.partials.table', compact('products'))->render();
        }

        $products = $this->repository
                         ->relationships('category')
                         ->orderBy('id')
                         ->paginate($this->totalPage);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.create', compact('categories'));
    }

    /**
     * @param StoreUpdateProductFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $dataForm = $request->all();

        if (!$this->repository->store($dataForm)) {
            return redirect()->route('products.create');
        }

        return redirect()->route('products.index')
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
        if (!$product = $this->repository->findById($id)) {
            return redirect()->back();
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->findById($id)) {
            return redirect()->back();
        }

        $categories = $this->repository->getAll();

        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * @param StoreUpdateProductFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $dataForm = $request->all();

        if (!$this->repository->update($id, $dataForm)) {
            return redirect()->route('admin.products.edit', $id)
                             ->with(['errors' => 'Falha ao editar']);
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->findById($id)) {
            return redirect()->back();
        }

        $this->repository->delete($id);

        return redirect()->route('products.index')
                         ->with('success', "Registro [{$product->id} -  {$product->name}] excluido com sucesso!");
    }

    public function search(Request $request)
    {
        $products = $this->repository->search($request);

        return View::make('admin.products.partials.table', compact('products'))->render();
    }
}
