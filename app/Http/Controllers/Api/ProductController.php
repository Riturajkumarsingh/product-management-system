<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a paginated listing of all products.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('images');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data'    => ProductResource::collection($products),
            'meta'    => [
                'current_page' => $products->currentPage(),
                'last_page'    => $products->lastPage(),
                'per_page'     => $products->perPage(),
                'total'        => $products->total(),
            ],
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): JsonResponse
    {
        $product->load('images');

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data'    => new ProductResource($product),
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'product_code' => ['required', 'string', 'max:100', 'unique:products,product_code'],
            'category'     => ['required', 'string', 'max:100'],
            'description'  => ['required', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
            'quantity'     => ['required', 'integer', 'min:0'],
            'status'       => ['required', 'in:active,inactive'],
            'images'       => ['nullable', 'array'],
            'images.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $product = Product::create($validator->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        $product->load('images');

        return response()->json([
            'success' => true,
            'message' => 'Product Created Successfully',
            'data'    => new ProductResource($product),
        ], 201);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'product_code' => ['required', 'string', 'max:100', "unique:products,product_code,{$product->id}"],
            'category'     => ['required', 'string', 'max:100'],
            'description'  => ['required', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
            'quantity'     => ['required', 'integer', 'min:0'],
            'status'       => ['required', 'in:active,inactive'],
            'images'       => ['nullable', 'array'],
            'images.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $product->update($validator->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        $product->load('images');

        return response()->json([
            'success' => true,
            'message' => 'Product Updated Successfully',
            'data'    => new ProductResource($product),
        ]);
    }

    /**
     * Remove the specified product and all its images.
     */
    public function destroy(Product $product): JsonResponse
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Deleted Successfully',
            'data'    => null,
        ]);
    }
}
