<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Repositories\Shoe\ShoeRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ShoeResource;

class ShoeController extends Controller {

    private $shoeRepository;

    public function __construct(ShoeRepositoryInterface $shoeRepository) {
        $this->shoeRepository = $shoeRepository;
    }

    public function index(Request $request) {
        try {
            $shoe = $this->shoeRepository->getShoes($request);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'shoes' => ShoeResource::collection($shoe->items()),
                'meta' => [
                    'total' => $shoe->total(),
                    'perPage' => $shoe->perPage(),
                    'currentPage' => $shoe->currentPage(),
                    'lastPage' => $shoe->lastpage()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request) {
        // $file = $request->image;
        // $fileName = time() . '-' . $file->getClientOriginalName();
        // $destinationPath = public_path('uploads');
        // $file->move($destinationPath, $fileName);
        // // C1
        // $fileStore = config('filesystems.imagePath') . '/' . $fileName;
        // // C2
        // // $fileStore = asset('uploads/'.$fileName);
        // $shoe = $this->shoeRepository->create([
        //     'name' => $request->name,
        //     'brand' => $request->brand,
        //     'color' => $request->color,
        //     'size' => $request->size,
        //     'gender' => $request->gender,
        //     'image' => $fileStore,
        //     'price' => $request->price
        // ]);
        // return response()->json($shoe);
        try {
            $shoe = Shoe::create([
                'brand_id' => 2,
                'category_id' => 2,
                'description' => 'This is favourite shoe all over the world',
                'price' => 500000,
                'name' => 'Nike air force 2'
            ]);

            for ($i = 1; $i < 3; $i++) {
                $shoe->shoeDetails()->create([
                    'size_id' => $i + 1,
                    'color_id' => $i + 1,
                    'quantity' => 10,
                    'stock' => 1
                ]);
            }

            return response()->json([
                'status' => true,
                'shoe' => $shoe,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function update(Request $request, $id) {
        $shoe = $this->shoeRepository->update($id, [
            'name' => $request->name,
            'brand' => $request->brand,
            'color' => $request->color,
            'size' => $request->size,
            'gender' => $request->gender,
            'price' => $request->price
        ]);
        return response()->json($shoe);
    }

    public function destroy($id) {
        $shoe = $this->shoeRepository->delete($id);

        return response()->json($shoe);
    }

    public function show($id) {
        try {
            $shoe = $this->shoeRepository->find($id);
            return response()->json([
                'status' => true,
                'message' => Response::HTTP_OK,
                'shoe' => new ShoeResource($shoe)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $th->getMessage()
            ]);
        }
    }
}
