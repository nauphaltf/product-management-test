@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List All Products</li>
        </ol>
        @if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Product<b> List</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ route('product.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Name</th>
                        <th>Description</th>
						<th>Image</th>
                        <th>Attributes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
                        <td>{{ $product->title }}</td>
                        <td>{{$product->description }}</td>
						<td><img src="{{ $product->main_image }}" height="100" width="100" /></td>
                        <td>
                            @foreach ($product->attributes as $attribute)
                            <div>{{ $attribute->attribute->title }} : {{ $attribute->value->value }}</div>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="{{ route('product.delete', $product->id) }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection