@extends('layouts.app')
@section('title', 'Products')
@section('page-title', 'Products')

@section('content')

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h1 style="font-size:1.25rem;font-weight:700;margin:0;">All Products</h1>
            <p class="text-muted mb-0" style="font-size:.825rem;">Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Add Product
        </a>
    </div>

    {{-- ── Search & Sort ───────────────────────────────────────── --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                <div class="row g-2 align-items-end">
                    {{-- Search --}}
                    <div class="col-md-5">
                        <label class="form-label">Search Products</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                class="form-control"
                                value="{{ $search }}"
                                placeholder="Search by name, code, or category..."
                                autocomplete="off"
                            >
                            @if($search)
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Sort By --}}
                    <div class="col-md-3">
                        <label class="form-label">Sort By</label>
                        <select name="sort_by" class="form-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Created Date</option>
                            <option value="name"       {{ $sortBy === 'name'       ? 'selected' : '' }}>Name</option>
                            <option value="price"      {{ $sortBy === 'price'      ? 'selected' : '' }}>Price</option>
                            <option value="category"   {{ $sortBy === 'category'   ? 'selected' : '' }}>Category</option>
                        </select>
                    </div>

                    {{-- Sort Order --}}
                    <div class="col-md-2">
                        <label class="form-label">Order</label>
                        <select name="sort_order" class="form-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Descending</option>
                            <option value="asc"  {{ $sortOrder === 'asc'  ? 'selected' : '' }}>Ascending</option>
                        </select>
                    </div>

                    {{-- Search Button --}}
                    <div class="col-md-2">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Products Table ──────────────────────────────────────── --}}
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span>
                <i class="bi bi-table me-2 text-primary"></i>
                {{ $products->total() }} Product{{ $products->total() != 1 ? 's' : '' }}
                @if($search)
                    <span class="text-muted">for "{{ $search }}"</span>
                @endif
            </span>
            <span class="text-muted" style="font-size:.8rem;">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </span>
        </div>

        <div class="card-body p-0">
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-0">
                        @if($search)
                            No products found matching "<strong>{{ $search }}</strong>".
                        @else
                            No products yet. Start by adding one!
                        @endif
                    </p>
                    @if(!$search)
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-3">
                            <i class="bi bi-plus-lg me-1"></i>Add First Product
                        </a>
                    @endif
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width:60px;">#</th>
                                <th style="width:64px;">Image</th>
                                <th>
                                    <a href="{{ route('products.index', ['sort_by'=>'name','sort_order'=>($sortBy==='name'&&$sortOrder==='asc')?'desc':'asc','search'=>$search]) }}" class="sort-link">
                                        Product Name
                                        @if($sortBy==='name') <i class="bi bi-arrow-{{ $sortOrder==='asc' ? 'up' : 'down' }}-short"></i> @endif
                                    </a>
                                </th>
                                <th>Code</th>
                                <th>
                                    <a href="{{ route('products.index', ['sort_by'=>'category','sort_order'=>($sortBy==='category'&&$sortOrder==='asc')?'desc':'asc','search'=>$search]) }}" class="sort-link">
                                        Category
                                        @if($sortBy==='category') <i class="bi bi-arrow-{{ $sortOrder==='asc' ? 'up' : 'down' }}-short"></i> @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('products.index', ['sort_by'=>'price','sort_order'=>($sortBy==='price'&&$sortOrder==='asc')?'desc':'asc','search'=>$search]) }}" class="sort-link">
                                        Price
                                        @if($sortBy==='price') <i class="bi bi-arrow-{{ $sortOrder==='asc' ? 'up' : 'down' }}-short"></i> @endif
                                    </a>
                                </th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>
                                    <a href="{{ route('products.index', ['sort_by'=>'created_at','sort_order'=>($sortBy==='created_at'&&$sortOrder==='asc')?'desc':'asc','search'=>$search]) }}" class="sort-link">
                                        Date
                                        @if($sortBy==='created_at') <i class="bi bi-arrow-{{ $sortOrder==='asc' ? 'up' : 'down' }}-short"></i> @endif
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index => $product)
                            <tr>
                                <td class="text-muted" style="font-size:.8rem;">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    @if($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image))
                                        <img src="{{ url('media/' . $product->images->first()->image) }}"
                                             alt="{{ $product->name }}" class="product-img">
                                    @else
                                        <div class="no-img"><i class="bi bi-image"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}"
                                       style="font-weight:600;color:#0f172a;text-decoration:none;">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>
                                    <code style="font-size:.75rem;background:#f1f5f9;padding:2px 6px;border-radius:4px;">
                                        {{ $product->product_code }}
                                    </code>
                                </td>
                                <td style="font-size:.8rem;">{{ $product->category }}</td>
                                <td><strong>₹{{ number_format($product->price, 2) }}</strong></td>
                                <td style="font-size:.875rem;">{{ $product->quantity }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->status_badge }}">
                                        {{ $product->status_label }}
                                    </span>
                                </td>
                                <td style="font-size:.75rem;color:#94a3b8;">
                                    {{ $product->created_at->format('M d, Y') }}
                                </td>
                                <td>
                                    <div class="d-flex gap-1 flex-nowrap">
                                        {{-- View --}}
                                        <a href="{{ route('products.show', $product) }}"
                                           class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        {{-- Delete --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete"
                                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($products->hasPages())
                <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <span class="text-muted" style="font-size:.8rem;">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                    </span>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
                @endif
            @endif
        </div>
    </div>

    {{-- ── Delete Confirmation Modal ──────────────────────────── --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px;border:none;">
                <div class="modal-header" style="border-bottom:1px solid #e2e8f0;">
                    <h5 class="modal-title fw-700" id="deleteModalLabel" style="font-weight:700;">
                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding:24px;">
                    <p class="mb-2" style="font-size:.9rem;">
                        Are you sure you want to delete
                        <strong id="delete-product-name" style="color:#6366f1;"></strong>?
                    </p>
                    <div class="alert alert-danger py-2" style="font-size:.8rem;">
                        <i class="bi bi-info-circle me-1"></i>
                        This will permanently delete the product and all its images. This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x me-1"></i>Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showSpinner()">
                            <i class="bi bi-trash me-1"></i>Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function confirmDelete(productId, productName) {
        document.getElementById('delete-product-name').textContent = productName;
        document.getElementById('deleteForm').action = `/products/${productId}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
