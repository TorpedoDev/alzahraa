<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SettingUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('setting.profile', compact('user'));
    }

    public function update(SettingUpdateRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        return redirect()->back()->with('success', 'تم تحديث إعدادات الحساب بنجاح');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $oldPass = $data['old_password'];
        if (! Hash::check($oldPass, Auth::user()->password)) {
            return redirect()->back()->with('error', 'كلمة المرور الحالية غير صحيحة');
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'تم تغيير كلمة المرور بنجاح');

    }

}
