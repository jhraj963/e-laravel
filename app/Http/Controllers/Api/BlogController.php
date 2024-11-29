<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function index()
    {
        $data = Blog::get();
        return $this->sendResponse($data, "Blog data retrieved successfully");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'overview' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoName = time() . rand(1111, 9999) . '.' . $request->photo->extension();
            $photoPath = public_path('/addproduct'); // Custom folder path
            $request->photo->move($photoPath, $photoName);
            $validatedData['photo'] = '/addproduct/' . $photoName; // Save relative path
        }

        $data = Blog::create($validatedData);
        return $this->sendResponse($data, "Blog created successfully");
    }

    public function show(Blog $blog)
    {
        return $this->sendResponse($blog, "Blog data retrieved successfully");
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'overview' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($blog->photo && file_exists(public_path($blog->photo))) {
                unlink(public_path($blog->photo));
            }

            $photoName = time() . rand(1111, 9999) . '.' . $request->photo->extension();
            $photoPath = public_path('/addproduct'); // Custom folder path
            $request->photo->move($photoPath, $photoName);
            $validatedData['photo'] = '/addproduct/' . $photoName; // Save relative path
        }

        $blog->update($validatedData);
        return $this->sendResponse($blog, "Blog updated successfully");
    }

    public function destroy(Blog $blog)
    {
        if ($blog->photo && file_exists(public_path($blog->photo))) {
            unlink(public_path($blog->photo)); // Delete the photo from storage
        }

        $blog->delete();
        return $this->sendResponse(null, "Blog deleted successfully");
    }
}
