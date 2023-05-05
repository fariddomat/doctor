<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\SettingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

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

        SettingLog::log('success', auth()->id(), 'Update Images', null);
        session()->flash('success', 'Successfully updated !');
        return redirect()->back();
    }

    public function gallery()
    {
        return view('dashboard.settings.gallery');
    }


    public function updateGallery(Request $request)
    {
        for ($i = 1; $i <= 8; $i++) {
            $img="image_".$i;
            // dd($request->image[$i-1]);
            try {
                if ($request->image[$i-1]) {
                $image_path = public_path("home/images/gallery/$img.jpg");
                // dd($image_path);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $request->image[$i-1]->move(public_path('/home/images/gallery'), "$img.jpg");
                // dd('true');
            }
            } catch (\Throwable $th) {
                //throw $th;
            }

        }


        SettingLog::log('success', auth()->id(), 'Update Gallery', null);
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

    public function services()
    {
        return view('dashboard.settings.services');
    }

    public function question()
    {
        return view('dashboard.settings.question');
    }

    public function settings(Request $request)
    {
        setting($request->all())->save();
        SettingLog::log('success', auth()->id(), 'Update Settings', null);
        session()->flash('success', 'Successfully updated !');
        return redirect()->back();
    }

    public function log()
    {
        $logs = SettingLog::latest()->paginate(10);
        return view('dashboard.settings.log', compact('logs'));
    }
}
