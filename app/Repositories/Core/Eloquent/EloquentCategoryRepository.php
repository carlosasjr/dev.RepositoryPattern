<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Http\Request;

class EloquentCategoryRepository extends BaseEloquentRepository
                                 implements CategoryRepositoryInterface
{
    public function entity()
    {
        return Category::class;
    }

    public function search(Request $request)
    {
       return $this->entity->where(function ($query) use ($request) {

           if ($request->id) {
                $query->where('id', $request->id);
            }

            if ($request->title) {
                $field = $request->title;
                $query->orWhere('title', 'like', "%{$field}%" );
            }

            if ($request->url) {
                $field = $request->url;
                $query->orWhere('url', 'like', "%{$field}%" );
            }

            if ($request->description) {
                $field = $request->description;
                $query->orWhere('description', 'like', "%{$field}%" );
            }
        })->paginate() ;
    }
}

