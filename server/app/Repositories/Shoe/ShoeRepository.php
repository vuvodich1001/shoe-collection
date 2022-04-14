<?php

namespace App\Repositories\Shoe;

use App\Models\Shoe;
use App\Repositories\BaseRepository;
use App\Repositories\Shoe\ShoeRepositoryInterface;
use Illuminate\Http\Request;

class ShoeRepository extends BaseRepository implements ShoeRepositoryInterface {
    //lấy model tương ứng
    public function getModel() {
        return Shoe::class;
    }

    public function getShoes(Request $request) {
        $shoes = $this->model->query();
        if ($request->gender) {
            // $genders = explode(',', $query['gender']);
            // foreach ($genders as $gender) {
            //     $shoes->where('gender', $gender);
            // }
            $shoes->where('gender', $request->gender);
        }
        if ($request->brand) {
            $shoes->where('brand', $request->brand);
        }
        if ($request->color) {
            $shoes->where('color', $request->color);
        }
        if ($request->size) {
            $shoes->where('size', $request->size);
        }
        if ($request->product) {
            $shoes->where('name', 'like', '%' . $request->product . '%');
        }
        if ($request->sortby) {
            $shoes->orderByRaw($request->sortby);
        }
        $limit = $query['limit'] ?? config('paginate.per_page');
        return $shoes->paginate($limit);
    }
}
