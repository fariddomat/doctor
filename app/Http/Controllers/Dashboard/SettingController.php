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

        if ($request->cover3) {
            $image_path = public_path("home/images/3.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->cover3->move(public_path('/home/images'), '3.jpg');
        }
        if ($request->cover2) {
            $image_path = public_path("home/images/2.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->cover2->move(public_path('/home/images'), '2.jpg');
        }
        if ($request->cover1) {
            $image_path = public_path("home/images/1.jpg");
            // dd($image_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $request->cover1->move(public_path('/home/images'), '1.jpg');
        }
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
