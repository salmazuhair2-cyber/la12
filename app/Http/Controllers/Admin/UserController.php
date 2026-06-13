<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    /* Show the form for creating a new resource. */
    public function create()
    {
        $roles = User::ROLES;
        $user = new User();
        return view('dashboard.users.create', compact('roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if (!auth()->user()->is_super_admin) {
            return redirect()->back()->with('error', 'Unauthorized!');
        }

        $data = $request->except('password', 'avatar');

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('alert', [
            'action'         => 'create',
            'message'        => 'User created successfully!',
            'back_route'     => route('admin.users.index'),
            'continue_route' => route('admin.users.create'),
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = User::ROLES;
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        if (!auth()->user()->is_super_admin) {
            return redirect()->back()->with('error', 'Unauthorized!');
        }

        $data = $request->except('password', 'avatar');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('alert', [
            'action'         => 'update',
            'message'        => 'User updated successfully!',
            'back_route'     => route('admin.users.index'),
            'continue_route' => route('admin.users.edit', $user),
        ]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('alert', [
            'action'         => 'delete',
            'message'        => 'User deleted successfully!',
            'back_route'     => route('admin.users.index'),
            'continue_route' => null,
        ]);
    }
}
