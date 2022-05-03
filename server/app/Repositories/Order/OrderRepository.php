<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\Address;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface {
    //lấy model tương ứng
    public function getModel() {
        return Order::class;
    }

    public function getAllOrders() {
    }

    public function createOrder(Request $request) {
        $customerId = Auth::user()->id;
        $orderInfo = [
            'customer_id' => $customerId,
            'address_id' => $request->addressId,
            'payment_method' => $request->paymentMethod,
            'shipping_fee' => $request->shippingFee,
            'discount' => $request->discount,
            'subtotal' => $request->subtotal,
            'status' => 'Đang xử lí',
            'total' => $request->total,
        ];

        $order = null;

        if ($request->addressId) {
            $order = $this->create($orderInfo);
        } else {
            $customerAddress = json_decode($request->newAddress, true);
            $address = Address::create([
                'customer_id' => $customerId,
                'name' => $customerAddress['name'],
                'line1' => $customerAddress['address'] . ', ' . $customerAddress['ward'],
                'line2' => $customerAddress['district'],
                'city' => $customerAddress['city'],
                'country' => 'Viet Nam',
                'phone' => $customerAddress['phone'],
                'default' => Address::find($customerId) ? 0 : 1
            ]);
            $order = $address->orders()->create($orderInfo);
        }

        foreach (json_decode($request->orderDetails, true) as $orderDetail) {
            $id = $orderDetail['shoe']['id'];
            $quantity = $orderDetail['quantity'];
            $subtotal = $orderDetail['quantity'] * $orderDetail['shoe']['price'];

            $order->shoes()->attach(
                [$id => ['quantity' => $quantity, 'subtotal' => $subtotal]]
            );
        }
        return $order;
    }

    public function getOrderByCustomerId($id) {
        $order = $this->model->find($id);
        return $order;
    }
}
