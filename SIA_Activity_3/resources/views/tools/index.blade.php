@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Tools Inventory</h1>
    <a href="{{ route('tools.create') }}" class="btn btn-primary">Add New Tool</a>
</div>

<!-- Search and Filter Bar -->
<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('tools.index') }}" method="GET" class="row g-2 align-items-center">
            <!-- Search Text Input -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or serial #..." value="{{ request('search') }}">
            </div>

            <!-- Category Filter -->
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="in use" {{ request('status') == 'in use' ? 'selected' : '' }}>In Use</option>
                    <option value="damaged" {{ request('status') == 'damaged' ? 'selected' : '' }}>Damaged</option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="col-md-2 d-flex">
                <button type="submit" class="btn btn-primary w-100 me-1">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if(request('search') || request('category') || request('status'))
                    <a href="{{ route('tools.index') }}" class="btn btn-outline-secondary" title="Reset Filters">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0 text-center">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Serial #</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tools as $tool)
                    <tr>
                        <td style="width: 80px;">
                            @if($tool->image_path)
                                <img src="{{ asset('storage/' . $tool->image_path) }}" alt="{{ $tool->tool_name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @elseif($tool->image_url)
                                <img src="{{ $tool->image_url }}" alt="{{ $tool->tool_name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light border text-muted" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 10px;">No Image</div>
                            @endif
                        </td>
                        <td>{{ $tool->tool_name }}</td>
                        <td>{{ $tool->category }}</td>
                        <td><code>{{ $tool->serial_number }}</code></td>
                        <td>
                            <span class="badge @if($tool->status == 'available') bg-success @elseif($tool->status == 'in use') bg-primary @else bg-warning @endif">
                                {{ ucfirst($tool->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('tools.show', $tool->id) }}" class="btn btn-info text-white">View</a>
                                <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No tool records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination Links -->
<div class="mt-4">
    {{ $tools->links('pagination::bootstrap-5') }}
</div>
@endsection
