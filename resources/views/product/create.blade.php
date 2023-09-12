@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create a new product</li>
        </ol>
        @if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
        <div class="col-md-6">
            <form method="post" action="{{ route('product.store') }}" id="product-form">
                @csrf
                <input type="hidden" name="image-path" id="image-path" />
                <div class="mb-3">
                  <label class="form-label">Product title</label>
                  <input type="text" required class="form-control" id="product-title" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Description</label>
                    <textarea required class="form-control" id="product-description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Attributes</label>
                    @foreach ($attributes as $attribute)
                    <div>{{ $attribute->title }} : 
                        <select class="form-control" name="attribute-{{$attribute->id}}">
                            <option value="">None</option>
                            @foreach($attribute->values as $value)
                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                </div>
            </form>
            <form action="{{ route('product.image-upload') }}" method="post" enctype="multipart/form-data" id="image-upload-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" required class="form-control" id="product-image" name="image">
                    <img id="demo-image" src="" style="display: none" height="100" width="100" />
                </div>
            </form>
            <div class="mb-3">
                <button id="product-save-btn" class="btn btn-success"> Save</button>
            </div>
        </div>
    </div>
</main>
@endsection