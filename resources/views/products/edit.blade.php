@extends('layouts.app')
@section('title', 'Edit: ' . $product->name)
@section('page-title', 'Edit Product')

@section('content')

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size:.8rem;">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.show', $product) }}" class="text-decoration-none">{{ Str::limit($product->name, 30) }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-pencil-fill text-warning me-2"></i>Edit Product</span>
                    <span class="text-muted" style="font-size:.8rem;">ID: #{{ $product->id }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" id="editForm">
                        @csrf
                        @method('PUT')

                        {{-- ── Row 1: Name + Code ─────────────────── --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="product_code" class="form-label">Product Code <span class="text-danger">*</span></label>
                                <input type="text" id="product_code" name="product_code"
                                       class="form-control @error('product_code') is-invalid @enderror"
                                       value="{{ old('product_code', $product->product_code) }}" required>
                                @error('product_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Row 2: Category + Price + Qty + Status ── --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select id="category" name="category"
                                        class="form-select @error('category') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="price" class="form-label">Price (₹) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" id="price" name="price" step="0.01" min="0"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price', $product->price) }}" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" id="quantity" name="quantity" min="0"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       value="{{ old('quantity', $product->quantity) }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select id="status" name="status"
                                        class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active"   {{ old('status', $product->status) == 'active'   ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Description ─────────────────────────── --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ── Existing Images ──────────────────────── --}}
                        @if($product->images->isNotEmpty())
                        <div class="mb-4">
                            <label class="form-label">Current Images</label>
                            <div class="row g-2">
                                @foreach($product->images as $image)
                                <div class="col-auto" id="existing-img-{{ $image->id }}">
                                    <div class="position-relative" style="width:90px;">
                                        <img src="{{ url('media/' . $image->image) }}"
                                             alt="Product image"
                                             style="width:90px;height:90px;object-fit:cover;border-radius:8px;border:2px solid #e2e8f0;"
                                             onerror="this.style.opacity='0'; this.parentElement.style.background='#f8fafc'; this.parentElement.style.border='2px dashed #cbd5e1';">
                                        <div class="form-check position-absolute"
                                             style="top:-6px;left:-6px;background:#fff;border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;border:1px solid #e2e8f0;"
                                             title="Check to remove this image">
                                            <input type="checkbox"
                                                   name="remove_images[]"
                                                   value="{{ $image->id }}"
                                                   id="remove_{{ $image->id }}"
                                                   class="form-check-input"
                                                   style="width:14px;height:14px;"
                                                   onchange="markForRemoval(this, {{ $image->id }})">
                                        </div>
                                        <label for="remove_{{ $image->id }}"
                                               class="position-absolute bottom-0 start-0 end-0 text-center"
                                               style="font-size:.6rem;background:rgba(0,0,0,.5);color:#fff;border-radius:0 0 6px 6px;padding:2px;cursor:pointer;">
                                            Remove
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div style="font-size:.75rem;color:#94a3b8;margin-top:6px;">
                                <i class="bi bi-info-circle me-1"></i>Check images to mark them for removal.
                            </div>
                        </div>
                        @endif

                        {{-- ── Upload New Images ────────────────────── --}}
                        <div class="mb-4">
                            <label for="images" class="form-label">Add New Images</label>
                            <div class="upload-area" id="upload-area"
                                 onclick="document.getElementById('images').click()"
                                 ondragover="dragOver(event)" ondrop="dropFiles(event)" ondragleave="dragLeave(event)"
                                 style="border:2px dashed #e2e8f0;border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;background:#fafbfc;">
                                <i class="bi bi-cloud-upload" style="font-size:1.8rem;color:#94a3b8;display:block;margin-bottom:6px;"></i>
                                <div style="font-weight:600;color:#475569;font-size:.875rem;">Click to add more images</div>
                                <div style="font-size:.75rem;color:#94a3b8;margin-top:4px;">JPG, JPEG, PNG, WEBP &mdash; Max 2MB each</div>
                            </div>
                            <input type="file" id="images" name="images[]" multiple accept="image/jpg,image/jpeg,image/png,image/webp"
                                   class="d-none" onchange="previewImages(this)">
                            <div class="image-preview-container mt-3" id="image-preview-container"></div>
                        </div>

                        {{-- ── Submit Buttons ───────────────────────── --}}
                        <div class="d-flex gap-2 justify-content-end border-top pt-3">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">
                                <i class="bi bi-x me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" onclick="showSpinner()">
                                <i class="bi bi-check-lg me-1"></i>Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let selectedFiles = [];

    function previewImages(input) {
        Array.from(input.files).forEach(file => {
            if (!selectedFiles.find(f => f.name === file.name && f.size === file.size)) {
                selectedFiles.push(file);
            }
        });
        renderPreviews();
    }

    function renderPreviews() {
        const container = document.getElementById('image-preview-container');
        container.innerHTML = '';
        selectedFiles.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = e => {
                const div = document.createElement('div');
                div.className = 'image-preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="preview">
                    <button type="button" class="image-preview-remove" onclick="removePreview(${idx})">
                        <i class="bi bi-x"></i>
                    </button>`;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        updateFileInput();
    }

    function removePreview(idx) {
        selectedFiles.splice(idx, 1);
        renderPreviews();
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        document.getElementById('images').files = dt.files;
    }

    function markForRemoval(checkbox, imgId) {
        const container = document.getElementById(`existing-img-${imgId}`);
        if (checkbox.checked) {
            container.querySelector('img').style.opacity = '0.35';
            container.querySelector('img').style.outline = '2px solid #ef4444';
        } else {
            container.querySelector('img').style.opacity = '1';
            container.querySelector('img').style.outline = 'none';
        }
    }

    function dragOver(e) {
        e.preventDefault();
        document.getElementById('upload-area').style.borderColor = '#6366f1';
        document.getElementById('upload-area').style.background  = 'rgba(99,102,241,.04)';
    }
    function dragLeave(e) {
        document.getElementById('upload-area').style.borderColor = '#e2e8f0';
        document.getElementById('upload-area').style.background  = '#fafbfc';
    }
    function dropFiles(e) {
        e.preventDefault();
        dragLeave(e);
        Array.from(e.dataTransfer.files).forEach(f => selectedFiles.push(f));
        renderPreviews();
    }
</script>
@endpush
