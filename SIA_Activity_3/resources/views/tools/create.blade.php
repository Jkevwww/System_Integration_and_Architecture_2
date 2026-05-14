@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0 h4">Add New Tool Record</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tool_name" class="form-label">Tool Name</label>
                            <input type="text" class="form-control" id="tool_name" name="tool_name" value="{{ old('tool_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Purchase Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Initial Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="in use" {{ old('status') == 'in use' ? 'selected' : '' }}>In Use</option>
                                <option value="damaged" {{ old('status') == 'damaged' ? 'selected' : '' }}>Damaged</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="storage_location" class="form-label">Storage Location</label>
                            <input type="text" class="form-control" id="storage_location" name="storage_location" value="{{ old('storage_location') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="assigned_to" class="form-label">Assigned To (Optional)</label>
                            <input type="text" class="form-control" id="assigned_to" name="assigned_to" value="{{ old('assigned_to') }}">
                        </div>
                    </div>

                    <!-- Bonus: Image Upload Fields -->
                    <hr class="my-4">
                    <h5 class="mb-3">Bonus: Tool Image</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image_file" class="form-label">Upload Local Image</label>
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image_url" class="form-label">External Image URL</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" placeholder="https://example.com/image.jpg" value="{{ old('image_url') }}">
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('tools.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Tool Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
