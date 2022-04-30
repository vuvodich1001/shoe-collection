<?php

namespace App\Repositories\Shoe;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface ShoeRepositoryInterface extends RepositoryInterface {
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getShoes(Request $request);

    public function getRelatedShoes($id);
}
