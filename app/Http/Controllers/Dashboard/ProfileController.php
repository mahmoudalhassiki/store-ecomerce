<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->user()->id);
            if($request->filled('password'))
            {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            //return $request;
            unset($request['password_confirmation']);
            unset($request['id']);
            $admin->update($request->all());
            return redirect()->back()->with(['success' => __('admin/sidebar.success')]);
        } catch (Exception $ex) {
            return redirect()->back()->with(['error' => __('admin/sidebar.error')]);
        }

    }
}
