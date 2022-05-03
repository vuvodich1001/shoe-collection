<?php

namespace App\Repositories\Shoe;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface ShoeRepositoryInterface extends RepositoryInterface {

    public function getShoes(Request $request);

    public function getRelatedShoes($id);
}
