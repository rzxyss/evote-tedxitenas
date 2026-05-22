<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    private const PHOTO_DIR = 'profile';
    public function index()
    {
        $data = [
            'title' => 'Account',
            'account' => User::all(),
        ];
        return view('content.account.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Account',
            'role' => Role::all(),
        ];
        return view('content.account.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|lowercase|unique:users,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:roles,name',
        ]);

        if ($request->hasFile('photo')) {
            $photoName = $this->storeUploadedFile($request->file('photo'), $request->name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoName ?? null,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('master-data.account.index')->with('success', 'Account created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = [
            'title' => 'Account',
            'account' => User::findOrFail($id),
            'role' => Role::all(),
        ];

        return view('content.account.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|lowercase|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:roles,name',
        ]);

        if ($request->hasFile('photo')) {
            $this->deleteStoredFile($user->photo);
            $photoName = $this->storeUploadedFile($request->file('photo'), $request->name);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'photo' => $photoName ?? $user->photo,
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('master-data.account.index')->with('success', 'Account updated successfully.');
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        $user = User::findOrFail($id);
        $this->deleteStoredFile($user->photo);
        $user->delete();

        return redirect()->route('master-data.account.index')->with('success', 'Account deleted successfully.');
    }

    private function storeUploadedFile($file, $name): ?string
    {
        if (!$file) {
            return null;
        }

        $extension = $file->getClientOriginalExtension();
        $name = preg_replace('/\s+/', '_', $name);
        $fileName = $name . '_' . uniqid() . '.' . $extension;

        $file->storeAs(self::PHOTO_DIR, $fileName, 'public');

        return $fileName;
    }

    private function deleteStoredFile(?string $fileName): void
    {
        if (!$fileName) {
            return;
        }

        $fullPath = self::PHOTO_DIR . '/' . $fileName;
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        }
    }
}
