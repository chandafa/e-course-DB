<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'lessons' => 'nullable|string',
            'about' => 'nullable|string',
            'benefits' => 'nullable|string',
            'reviews' => 'nullable|string',
            'tools' => 'nullable|string',
            'faqs' => 'nullable|string',
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->lessons = $request->lessons;
        $course->about = $request->about;
        $course->benefits = $request->benefits;
        $course->reviews = $request->reviews;
        $course->tools = $request->tools;
        $course->faqs = $request->faqs;

        if ($request->hasFile('image')) {
            $course->image = $request->file('image')->store('images', 'public');
        }

        $course->save();
        return response()->json(['status' => 200, 'message' => 'Course created successfully', 'data' => $course], 201);
    }


    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'lessons' => 'nullable|string',
            'about' => 'nullable|string',
            'benefits' => 'nullable|string',
            'reviews' => 'nullable|string',
            'tools' => 'nullable|string',
            'faqs' => 'nullable|string',
        ]);

        $course->title = $request->title;
        $course->description = $request->description;
        $course->lessons = $request->lessons;
        $course->about = $request->about;
        $course->benefits = $request->benefits;
        $course->reviews = $request->reviews;
        $course->tools = $request->tools;
        $course->faqs = $request->faqs;

        if ($request->hasFile('image')) {
            $course->image = $request->file('image')->store('images', 'public');
        }

        $course->save();
        return response()->json(['message' => 'Course updated successfully', 'course' => $course]);
    }


    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
