<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{

    public function images()
    {
        return view('dashboard.settings.images');
    }

    public function updateImages(Request $request)
    {

        if ($request->icon) {
            $image_path = public_path("home/images/icon.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->icon->move(public_path('/home/images'), 'icon.jpg');
        }
        if ($request->cover) {
            $image_path = public_path("home/images/cover.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->cover->move(public_path('/home/images'), 'cover.jpg');
        }
        if ($request->doctor) {
            $image_path = public_path("home/images/doctor.jpg");
            // dd($image_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->doctor->move(public_path('/home/images'), 'doctor.jpg');
        }
        session()->flash('success', 'Successfully updated !');
        return redirect()->back();
    }

    public function about()
    {
        return view('dashboard.settings.about');
    }

    public function social()
    {
        return view('dashboard.settings.social');
    }

    public function settings(Request $request)
    {
        setting($request->all())->save();
        session()->flash('success', 'Successfully updated !');
        return redirect()->back();
    }
}
