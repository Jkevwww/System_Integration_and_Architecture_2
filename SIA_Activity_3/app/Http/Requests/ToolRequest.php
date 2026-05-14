<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('tool') ? $this->route('tool')->id : null;

        return [
            'tool_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:tools,serial_number,' . $id,
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'status' => 'required|string',
            'storage_location' => 'required|string',
            'assigned_to' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'tool_name.required' => 'The tool name is mandatory.',
            'serial_number.unique' => 'This serial number is already registered to another tool.',
            'image_file.image' => 'The uploaded file must be an image.',
            'image_url.url' => 'Please provide a valid URL for the image.',
        ];
    }
}
