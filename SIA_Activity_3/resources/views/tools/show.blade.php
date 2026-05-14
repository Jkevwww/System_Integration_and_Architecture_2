@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0 h4">Tool Details: {{ $tool->tool_name }}</h2>
                <a href="{{ route('tools.index') }}" class="btn btn-light btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        @if($tool->image_path)
                            <img src="{{ asset('storage/' . $tool->image_path) }}" alt="{{ $tool->tool_name }}" class="img-fluid rounded shadow-sm">
                        @elseif($tool->image_url)
                            <img src="{{ $tool->image_url }}" alt="{{ $tool->tool_name }}" class="img-fluid rounded shadow-sm">
                        @else
                            <div class="bg-light border text-muted rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                No Image Available
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th class="bg-light" style="width: 40%;">Tool Name</th>
                                <td>{{ $tool->tool_name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Category</th>
                                <td>{{ $tool->category }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Serial Number</th>
                                <td><code>{{ $tool->serial_number }}</code></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Status</th>
                                <td>
                                    <span class="badge @if($tool->status == 'available') bg-success @elseif($tool->status == 'in use') bg-primary @else bg-warning @endif">
                                        {{ ucfirst($tool->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light" style="width: 30%;">Purchase Price</th>
                        <td>${{ number_format($tool->price, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Purchase Date</th>
                        <td>{{ $tool->purchase_date }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Storage Location</th>
                        <td>{{ $tool->storage_location }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Assigned To</th>
                        <td>{{ $tool->assigned_to ?? 'Not Assigned' }}</td>
                    </tr>
                </table>

                <div class="mt-4 text-end">
                    <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-warning">Edit Record</a>
                    <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
