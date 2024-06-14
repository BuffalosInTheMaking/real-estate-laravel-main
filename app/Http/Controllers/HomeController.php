<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        // Check if the properties table exists
        if (Schema::hasTable('properties')) {
            $featuredProperties = Property::where('is_featured', true)->get();
        } else {
            // Handle the case where the table does not exist
            $featuredProperties = collect(); // Return an empty collection
            // Optionally, you could set an error message
            $error = 'The properties table does not exist. Please run the migrations.';
        }

        // Pass the data to the view
        return view('home', [
            'featuredProperties' => $featuredProperties,
            'error' => $error ?? null
        ]);
    }
}
