<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProductRequest $request, ProductService $productService)
    {
        $data = $request->validated();

        return ProductResource::collection($productService->getAll($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ProductService $productService)
    {
        try {
            $product = $productService->create(...$request->validated());

            return response()->json(['product' => $product, 'message' => 'Product created successfully !!']);

        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'Product creation failed, please try again later.'], Response::HTTP_BAD_REQUEST);
        }
    }
}
