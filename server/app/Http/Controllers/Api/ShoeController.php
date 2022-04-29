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
        try {
            $shoe = $this->shoeRepository->create([
                'brand_id' => $request->brand,
                'category_id' => $request->category,
                'description' =>  $request->description,
                'price' => $request->price,
                'name' => $request->name,
                'gender' => $request->gender
            ]);

            $length = count($request->colors);
            $colors = $request->colors;
            $images = $request->images;
            $checkDefaultImage = [];
            for ($i = 0; $i < $length; $i++) {
                $file = $images[$i];
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('uploads');
                $file->move($destinationPath, $fileName);
                // C1
                $fileStore = config('filesystems.imagePath') . '/' . $fileName;
                // C2
                // $fileStore = asset('uploads/'.$fileName);
                $shoe->images()->create([
                    'color_id' => $colors[$i],
                    'image' => $fileStore,
                    'image_short' => $fileName,
                    'default' => in_array($colors[$i], $checkDefaultImage) ? 0 : 1
                ]);
                in_array($colors[$i], $checkDefaultImage) ? '' : $checkDefaultImage[] = $colors[$i];
            }
            foreach (json_decode($request->details, true) as $detail) {
                $shoe->shoeDetails()->create([
                    'size_id' => $detail['size'],
                    'color_id' => $detail['color'],
                    'quantity' => $detail['quantity'],
                    'stock' => 1
                ]);
            }
            return response()->json([
                'status' => true,
                'shoe' => $shoe
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'detail' => json_decode($request->details, true),
                'image' => json_decode($request->images, true)
            ]);
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
