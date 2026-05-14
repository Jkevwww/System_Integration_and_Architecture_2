<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validation Rules
        $rules = [
            'full_name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'creature_name' => 'required|min:2',
            'creature_type' => 'required',
            'description' => 'required|min:10',
            'agreement' => 'required'
        ];

        // Custom Validation Messages
        $messages = [
            'full_name.required' => 'We need to know who you are. Please provide your full name.',
            'creature_type.required' => 'Please select the type of creature you are registering.',
            'description.min' => 'The description is too short. Please provide at least 10 characters.',
            'agreement.required' => 'You must agree to the terms of the Almanac.'
        ];

        $validated = $request->validate($rules, $messages);

        // If validation passes, we redirect with success message
        return redirect()->route('registration.form')->with('success', 'Mythological creature registered successfully in the Almanac!');
    }
}
