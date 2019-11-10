<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;

class EloquentProductRepository extends BaseEloquentRepository
                                implements ProductRepositoryInterface
{
    public function entity()
    {
        return Product::class;
    }

    public function search(Request $request)
    {
        return $this->entity
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $filter = $request->name;
                    $query->where(function ($querySub) use ($filter) {
                        $querySub->where('name', 'LIKE', "%{$filter}%")
                            ->orWhere('description', 'LIKE', "%{$filter}%");
                    });
                }
                if ($request->url) {
                    $query->where('url', $request->url);
                }
                if ($request->category_id) {
                    $query->orWhere('category_id', $request->category_id);
                }
            })
            ->paginate();
    }
}

