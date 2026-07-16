@extends('layouts.app')
@section('title', $product->name)
@section('page-title', 'Product Details')

@section('content')

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size:.8rem;">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- ── Image Gallery ──────────────────────────────── --}}
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-images me-2 text-primary"></i>Product Gallery
                    <span class="badge bg-secondary ms-2">{{ $product->images->count() }} image{{ $product->images->count() != 1 ? 's' : '' }}</span>
                </div>
                <div class="card-body">
                    @if($product->images->isNotEmpty() && Storage::disk('public')->exists($product->images->first()->image))
                        {{-- Main Image --}}
                        <div class="mb-3 text-center">
                            <img src="{{ url('media/' . $product->images->first()->image) }}"
                                 id="main-gallery-img"
                                 alt="{{ $product->name }}"
                                 style="width:100%;max-height:280px;object-fit:contain;border-radius:10px;border:1px solid #e2e8f0;background:#f8fafc;cursor:zoom-in;"
                                 onclick="openLightbox(this.src)"
                                 onerror="this.src='';this.style.display='none';this.parentElement.innerHTML='<div class=\'text-center py-4\'><i class=\'bi bi-image display-4 text-muted\'></i><p class=\'text-muted mt-2\'>Image not found</p></div>'">
                        </div>

                        {{-- Thumbnails --}}
                        @if($product->images->count() > 1)
                        <div class="gallery-grid" style="grid-template-columns:repeat(auto-fill,minmax(70px,1fr));">
                            @foreach($product->images as $image)
                            <div class="gallery-item">
                                <img src="{{ url('media/' . $image->image) }}"
                                     alt="Thumbnail"
                                     style="width:100%;height:70px;object-fit:cover;border-radius:6px;border:2px solid #e2e8f0;cursor:pointer;transition:all .2s;"
                                     onclick="setMainImage('{{ url('media/' . $image->image) }}', this)"
                                     onerror="this.style.display='none'"
                                     class="gallery-thumb">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-image display-4 text-muted d-block mb-3"></i>
                            <p class="text-muted" style="font-size:.875rem;">No images uploaded</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Product Details ─────────────────────────────── --}}
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-info-circle me-2 text-primary"></i>Product Information</span>
                    <span class="badge bg-{{ $product->status_badge }}" style="font-size:.8rem;">
                        {{ $product->status_label }}
                    </span>
                </div>
                <div class="card-body">

                    <h1 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:4px;">{{ $product->name }}</h1>
                    <code style="font-size:.85rem;background:#f1f5f9;padding:3px 8px;border-radius:4px;color:#6366f1;">
                        {{ $product->product_code }}
                    </code>

                    <hr style="margin:16px 0;border-color:#e2e8f0;">

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Category</div>
                            <div style="font-size:.9rem;font-weight:500;margin-top:4px;">
                                <i class="bi bi-tag-fill text-primary me-1"></i>{{ $product->category }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Price</div>
                            <div style="font-size:1.3rem;font-weight:800;color:#10b981;margin-top:4px;">
                                ₹{{ number_format($product->price, 2) }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Quantity</div>
                            <div style="font-size:.9rem;font-weight:500;margin-top:4px;">
                                <i class="bi bi-boxes me-1 text-primary"></i>{{ $product->quantity }} units
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Images</div>
                            <div style="font-size:.9rem;font-weight:500;margin-top:4px;">
                                <i class="bi bi-images me-1 text-primary"></i>{{ $product->images->count() }} file(s)
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;">Description</div>
                        <div style="font-size:.875rem;line-height:1.6;color:#374151;background:#f8fafc;border-radius:8px;padding:12px;border:1px solid #e2e8f0;">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    {{-- Timestamps --}}
                    <div class="row g-2">
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Created</div>
                            <div style="font-size:.8rem;color:#475569;margin-top:4px;">
                                <i class="bi bi-calendar3 me-1"></i>{{ $product->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:.7rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Last Updated</div>
                            <div style="font-size:.8rem;color:#475569;margin-top:4px;">
                                <i class="bi bi-pencil me-1"></i>{{ $product->updated_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <hr style="margin:16px 0;border-color:#e2e8f0;">

                    {{-- Actions --}}
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i>Edit Product
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back to List
                        </a>
                        <button type="button" class="btn btn-outline-danger ms-auto"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- ── Delete Modal ─────────────────────────────────── --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px;border:none;">
                <div class="modal-header">
                    <h5 class="modal-title fw-700" style="font-weight:700;">
                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Delete <strong id="delete-name" style="color:#6366f1;"></strong>?</p>
                    <div class="alert alert-danger py-2" style="font-size:.8rem;">
                        This action cannot be undone. All images will also be deleted.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showSpinner()">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Lightbox Modal ─────────────────────────────────── --}}
    <div class="modal fade" id="lightboxModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background:transparent;border:none;">
                <div class="modal-body text-center p-2">
                    <img id="lightbox-img" src="" alt="Full size" style="max-width:100%;max-height:80vh;border-radius:12px;">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function setMainImage(src, thumb) {
        document.getElementById('main-gallery-img').src = src;
        document.querySelectorAll('.gallery-thumb').forEach(t => t.style.borderColor = '#e2e8f0');
        if (thumb) thumb.style.borderColor = '#6366f1';
    }

    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        new bootstrap.Modal(document.getElementById('lightboxModal')).show();
    }

    function confirmDelete(id, name) {
        document.getElementById('delete-name').textContent = name;
        document.getElementById('deleteForm').action = `/products/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
