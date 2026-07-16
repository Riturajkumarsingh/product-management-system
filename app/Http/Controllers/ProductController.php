<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products with search, sort, and pagination.
     */
    public function index(Request $request): View
    {
        $query = Product::with('images');

        // Search functionality
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        $sortBy    = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $allowedSorts = ['name', 'price', 'category', 'created_at', 'quantity'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact('products', 'search', 'sortBy', 'sortOrder'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = $this->getCategories();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product "' . $product->name . '" has been created successfully!');
    }

    /**
     * Display the specified product with its images.
     */
    public function show(Product $product): View
    {
        $product->load('images');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $product->load('images');
        $categories = $this->getCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     * Handles new image uploads and removal of selected images.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->safe()->except(['images', 'remove_images']));

        // Remove selected images
        if ($request->has('remove_images') && is_array($request->remove_images)) {
            $imagesToRemove = ProductImage::whereIn('id', $request->remove_images)
                ->where('product_id', $product->id)
                ->get();

            foreach ($imagesToRemove as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product "' . $product->name . '" has been updated successfully!');
    }

    /**
     * Remove the specified product and all its images from storage and database.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete all associated images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $productName = $product->name;
        $product->delete(); // Cascade deletes images from DB

        return redirect()->route('products.index')
            ->with('success', 'Product "' . $productName . '" and all its images have been deleted.');
    }

    /**
     * Get predefined category list.
     *
     * @return array<string>
     */
    private function getCategories(): array
    {
        return [
            'Electronics',
            'Clothing & Apparel',
            'Home & Garden',
            'Sports & Outdoors',
            'Books & Media',
            'Health & Beauty',
            'Toys & Games',
            'Automotive',
            'Food & Beverages',
            'Office Supplies',
            'Furniture',
            'Jewelry & Accessories',
            'Baby & Kids',
            'Pet Supplies',
            'Other',
        ];
    }
}
