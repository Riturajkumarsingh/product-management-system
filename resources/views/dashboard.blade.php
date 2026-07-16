@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- ── Welcome Banner ────────────────────────────────────── --}}
    <div class="card mb-4" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none;border-radius:16px;overflow:hidden;">
        <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2 class="text-white fw-700 mb-1" style="font-size:1.4rem;font-weight:800;">
                    Welcome back, {{ auth()->user()->name }}! 👋
                </h2>
                <p class="text-white mb-0" style="opacity:.8;font-size:.875rem;">
                    {{ now()->format('l, F j, Y') }} &mdash; Here's what's happening with your products.
                </p>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-light btn-sm fw-600 d-flex align-items-center gap-2" style="font-weight:600;border-radius:8px;">
                <i class="bi bi-plus-lg"></i> Add Product
            </a>
        </div>
    </div>

    {{-- ── Stat Cards ─────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card fade-in-up">
                <div class="stat-icon purple"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card fade-in-up" style="animation-delay:.05s">
                <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $activeProducts }}</div>
                    <div class="stat-label">Active Products</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card fade-in-up" style="animation-delay:.1s">
                <div class="stat-icon orange"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $inactiveProducts }}</div>
                    <div class="stat-label">Inactive</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card fade-in-up" style="animation-delay:.15s">
                <div class="stat-icon blue"><i class="bi bi-images"></i></div>
                <div>
                    <div class="stat-value">{{ $totalImages }}</div>
                    <div class="stat-label">Total Images</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Quick Actions ───────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('products.create') }}" class="card text-decoration-none fade-in-up" style="transition:transform .2s;animation-delay:.2s;">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="stat-icon purple" style="width:40px;height:40px;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div>
                        <div style="font-size:.875rem;font-weight:600;color:#0f172a;">Add New Product</div>
                        <div style="font-size:.75rem;color:#64748b;">Create a new listing</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="card text-decoration-none fade-in-up" style="transition:transform .2s;animation-delay:.25s;">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="stat-icon green" style="width:40px;height:40px;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-list-ul"></i>
                    </div>
                    <div>
                        <div style="font-size:.875rem;font-weight:600;color:#0f172a;">View All Products</div>
                        <div style="font-size:.75rem;color:#64748b;">Browse your inventory</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <div class="card fade-in-up" style="animation-delay:.3s;">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="stat-icon blue" style="width:40px;height:40px;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div style="min-width:0;">
                        <div style="font-size:.875rem;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                        <div style="font-size:.75rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Latest Products Table ───────────────────────────────── --}}
    <div class="card fade-in-up" style="animation-delay:.35s;">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="bi bi-clock-history me-2 text-primary"></i>Latest Products</span>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="card-body p-0">
            @if($latestProducts->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-1">No products yet.</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-2">
                        <i class="bi bi-plus-lg me-1"></i>Add First Product
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestProducts as $product)
                            <tr>
                                <td>
                                    @if($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image))
                                        <img src="{{ url('media/' . $product->images->first()->image) }}"
                                             alt="{{ $product->name }}"
                                             class="product-img">
                                    @else
                                        <div class="no-img"><i class="bi bi-image"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight:600;font-size:.875rem;">{{ $product->name }}</div>
                                </td>
                                <td><code style="font-size:.75rem;background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ $product->product_code }}</code></td>
                                <td><span style="font-size:.8rem;">{{ $product->category }}</span></td>
                                <td><strong>₹{{ number_format($product->price, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $product->status_badge }}">
                                        {{ $product->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
