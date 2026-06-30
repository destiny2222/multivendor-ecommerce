<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::orderBy('sort_order')->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(SliderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            // save directly to public folder
            $request->image->move(public_path('upload/sliders'), $imageName);
            $validated['image'] = $imageName;
        }

        if ($request->hasFile('background_image')) {
           $backgroundImageName = time() . '_bg.' . $request->background_image->extension();
           // save directly to public folder
            $request->background_image->move(public_path('upload/sliders'), $backgroundImageName);
            $validated['background_image'] = $backgroundImageName;
        }

        $validated['is_active'] = $request->has('is_active');
       
        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($slider->image) {
                // delete old image
                $oldImagePath = str_replace('public/', '', $slider->image);
                if (file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }
            }
            $imageName = time() . '.' . $request->image->extension();
            // save directly to public folder
            $request->image->move(public_path('upload/sliders'), $imageName);
            $validated['image'] = $imageName;
        }

        if ($request->hasFile('background_image')) {
            if ($slider->background_image) {
               // delete old image
                $oldBgPath = str_replace('public/', '', $slider->background_image);
                if (file_exists(public_path($oldBgPath))) {
                    unlink(public_path($oldBgPath));
                }
            }
            $backgroundImageName = time() . '_bg.' . $request->background_image->extension();
            // save directly to public folder
            $request->background_image->move(public_path('upload/sliders'), $backgroundImageName);
            $validated['background_image'] = $backgroundImageName;
        }

        $validated['is_active'] = $request->has('is_active');

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        if ($slider->image) {
            $imagePath = str_replace('public/', '', $slider->image);
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }
        if ($slider->background_image) {
            $imagePath = str_replace('public/', '', $slider->background_image);
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
