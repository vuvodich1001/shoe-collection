<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $file = $request->image;
            $fileStore = '';
            if (isset($file)) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('reviews');
                $file->move($destinationPath, $fileName);
                $fileStore = asset('reviews/' . $fileName);
            }

            $review = Review::create([
                'customer_id' => Auth::user()->id,
                'shoe_id' => $request->shoeId,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'image' => empty($fileStore) ? '' : $fileStore
            ]);
            return response()->json([
                'status' => true,
                'review' => $review
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function getReviewsByShoeId($id) {
        try {
            $reviews = Review::with('customer')->where('shoe_id', $id)->paginate(3);
            return response()->json([
                'status' => true,
                'reviews' => $reviews->items(),
                'meta' => [
                    'total' => $reviews->total(),
                    'perPage' => $reviews->perPage(),
                    'currentPage' => $reviews->currentPage(),
                    'lastPage' => $reviews->lastpage()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
