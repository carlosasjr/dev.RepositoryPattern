<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Core\BaseQueryBuilderRepository;
use Illuminate\Http\Request;

class QueryBuilderCategoryRepository extends BaseQueryBuilderRepository
                                     implements CategoryRepositoryInterface
{
    protected $table = 'categories';


    public function store(array $data)
    {
        $data['url'] = kebab_case($data['title']);
        return parent::store($data);
    }

    public function update($id, array $data)
    {
        $data['url'] = kebab_case($data['title']);
        return parent::update($id, $data);
    }


    public function search(array $data)
    {
        return $this->db
            ->table($this->tb)
            ->where(function ($query) use ($data) {
                if (isset($data['title'])) {
                    $query->where('title', 'LIKE', "%{$data['title']}%");
                }
                if (isset($data['url'])) {
                    $query->where('url', 'LIKE', "%{$data['url']}%");
                }
                if (isset($data['description'])) {
                    $desc = $data['description'];
                    $query->where('description', 'LIKE', "%{$desc}%");
                }
            })
            ->orderBy('id', 'desc')
            ->paginate();
    }
}


