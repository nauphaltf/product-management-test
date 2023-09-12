@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Attributes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List All Attributes</li>
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
                        <h2>Attribute<b> List</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addAttributeModal" class="btn btn-success" data-bs-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Attribute</span></a>
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
                        <th>Values</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attributes as $attribute)
					<tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td>{{ $attribute->title }}</td>
                        <td>{{ $attribute->values->pluck('value')->implode(', ') }}</td>
                        <td>
                            <a href="{{ route('attribute.delete', $attribute->id) }}" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @empty
					<tr>
                        <td colspan="4">No records found</td>
					</tr>
                    @endforelse
                </tbody>
            </table>
             <!-- Modal -->
            <div class="modal fade" id="addAttributeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                              <label class="form-label">Attribute title</label>
                              <input type="text" required class="form-control" id="attr-title" name="title">
							  <div id="attr-title-error" class="error"></div>
                            </div>
							<div class="mb-3">
								<label class="form-label">Attribute values (separated by commas)</label>
								<input type="text" required class="form-control" id="attr-value" name="value">
								<div id="attr-value-error" class="error"></div>
							  </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-attr-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection