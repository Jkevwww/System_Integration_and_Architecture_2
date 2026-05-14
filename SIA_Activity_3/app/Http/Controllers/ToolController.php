<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Http\Requests\ToolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $status = $request->input('status');

        $tools = Tool::query()
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('tool_name', 'like', "%{$search}%")
                      ->orWhere('serial_number', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->when($status, function ($status_query, $status) {
                return $status_query->where('status', $status);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        // Get unique categories for the filter dropdown
        $categories = Tool::distinct()->pluck('category');

        return view('tools.index', compact('tools', 'categories'));
    }

    public function create()
    {
        return view('tools.create');
    }

    public function store(ToolRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            $data['image_path'] = $request->file('image_file')->store('tools', 'public');
        }

        Tool::create($data);

        return redirect()->route('tools.index')->with('success', 'Tool record added successfully.');
    }

    public function show(Tool $tool)
    {
        return view('tools.show', compact('tool'));
    }

    public function edit(Tool $tool)
    {
        return view('tools.edit', compact('tool'));
    }

    public function update(ToolRequest $request, Tool $tool)
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            // Delete old image if exists
            if ($tool->image_path) {
                Storage::disk('public')->delete($tool->image_path);
            }
            $data['image_path'] = $request->file('image_file')->store('tools', 'public');
        }

        $tool->update($data);

        return redirect()->route('tools.index')->with('success', 'Tool record updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        if ($tool->image_path) {
            Storage::disk('public')->delete($tool->image_path);
        }
        
        $tool->delete();

        return redirect()->route('tools.index')->with('success', 'Tool record deleted successfully.');
    }
}
