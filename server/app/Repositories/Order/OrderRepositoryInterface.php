<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface OrderRepositoryInterface extends RepositoryInterface {
    public function getAllOrders();

    public function createOrder(Request $request);

    public function getOrderByCustomerId($id);
}
