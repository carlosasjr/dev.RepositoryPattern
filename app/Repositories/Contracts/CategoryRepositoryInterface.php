<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
   // public function search(array $data);
    public function search(Request $request);
}

