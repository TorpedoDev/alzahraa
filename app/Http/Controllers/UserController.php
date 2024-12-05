<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin'),
            new Middleware('moderator', ['create', 'store', 'edit', 'update'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'employee')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        unset($data['password_confirmation']);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        $data = $request->validated();
        unset($data['password_confirmation']);
        if ($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'تم تعديل بيانات المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'تم حذف بيانات المستخدم بنجاح');
    }

    public function activation($id)
    {
        $user = User::find($id);

        $user->active = !$user->active;
        $user->save();

        if ($user->active == 1) {
            return redirect()->route('user.index')->with('success', 'تم تنشيط المستخدم بنجاح');
        } else {
            return redirect()->route('user.index')->with('success', 'تم الغاء تنشيط المستخدم بنجاح');
        }
    }
}
