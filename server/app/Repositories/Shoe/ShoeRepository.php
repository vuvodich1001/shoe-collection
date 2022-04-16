<?php

namespace App\Repositories\Shoe;

use App\Http\Resources\ShoeResource;
use App\Models\Shoe;
use App\Repositories\BaseRepository;
use App\Repositories\Shoe\ShoeRepositoryInterface;
use Illuminate\Http\Request;

class ShoeRepository extends BaseRepository implements ShoeRepositoryInterface {
    //lấy model tương ứng
    public function getModel() {
        return Shoe::class;
    }

    protected function filter($model, $attribute, $attributeName) {
        $attributes = explode(',', $attribute);
        $model->whereHas('shoeDetails', function ($query) use ($attributes, $attributeName) {
            $query->with($attributeName)->whereHas($attributeName, function ($query) use ($attributes) {
                $query->where(function ($query) use ($attributes) {
                    foreach ($attributes as $color) {
                        $query->orWhere('name', $color);
                    }
                });
            });
        });
    }

    public function getShoes(Request $request) {
        $shoes = $this->model->query()->with('brand', 'category', 'shoeDetails');
        $brand = $request->brand;
        $color = $request->color;
        $size = $request->size;
        $product = $request->product;
        $sortby = $request->sortby;
        if ($request->gender) {
            // $genders = explode(',', $query['gender']);
            // foreach ($genders as $gender) {
            //     $shoes->where('gender', $gender);
            // }
            $shoes->where('gender', $request->gender);
        }
        if ($brand) {
            $shoes->whereHas('brand', function ($query) use ($brand) {
                $query->where('name', $brand);
            });
        }
        if ($color) {
            $this->filter($shoes, $color, 'color');
        }
        if ($size) {
            $this->filter($shoes, $size, 'size');
        }
        if ($product) {
            $shoes->where('name', 'like', '%' . $product . '%');
        }
        if ($request->sortby) {
            $shoes->orderByRaw($request->sortby);
        }
        $limit = $request->limit ?? config('paginate.per_page');
        return $shoes->paginate($limit);
    }
}
