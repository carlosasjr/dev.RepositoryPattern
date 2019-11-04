<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use function foo\func;

class ProductController extends Controller
{
    protected $product;
    protected $totalPage = 1;

    public function __construct(Product $product)
    {
        $this->product = $product;
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

            $products = $this->product
                ->orderBy('id', 'desc')
                ->paginate($this->totalPage);

            return View::make('admin.products.partials.table', compact('products'))->render();
        }

        $products = $this->product
            ->orderBy('id', 'desc')
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
        //  $categories = Category::all()->pluck('title', 'id');

        $categories->prepend('Selecionar', '');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * @param StoreUpdateProductFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->product->create($dataForm);

        if (!$insert) {
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
        $product = $this->product->with('category')
            ->find($id);

        if (!$product) {
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
        $product = $this->product->find($id);

        if (!$product) {
            return redirect()->back();
        }

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

        $product = $this->product->find($id);

        $product->update($dataForm);

        if (!$product) {
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
        $product = $this->product->find($id);

        if (!$product) {
            return redirect()->back();
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', "Registro [{$product->id} -  {$product->name}] excluido com sucesso!");
    }

    public function search(Request $request)
    {
        $dataForm = $request->all();

        /*  $categories = $this->category->where('title', 'like', "%{$search}%")
                                       ->orWhere('url', 'like', "%{$search}%")
                                       ->orWhere('description', 'like', "%{$search}%")
                                       ->paginate($this->totalPage);*/


        $products = $this->product->with('category')
            ->where(function ($query) use ($dataForm) {

                if (isset($dataForm['id'])) {
                    $query->where('id', $dataForm['id']);
                }

                if (isset($dataForm['category_id'])) {
                    $field = $dataForm['category_id'];
                    $query->orWhere('category_id', '=', "{$field}");
                }

                if (isset($dataForm['name'])) {
                    $field = $dataForm['name'];
                    $query->orWhere('name', 'like', "%{$field}%");
                }

                if (isset($dataForm['url'])) {
                    $field = $dataForm['url'];
                    $query->orWhere('url', 'like', "%{$field}%");
                }

                if (isset($dataForm['description'])) {
                    $field = $dataForm['description'];
                    $query->orWhere('description', 'like', "%{$field}%");
                }

            })->orderBy('id', 'desc')
            ->paginate($this->totalPage);

        return View::make('admin.products.partials.table', compact('products'))->render();
    }
}
