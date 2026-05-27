<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    private const PHOTO_DIR = 'profile';
    public function index()
    {
        checkingPermission('user_view');
        $data = [
            'title' => 'Account',
            'account' => User::all(),
        ];
        return view('content.account.index', $data);
    }

    public function create()
    {
        checkingPermission('user_create');
        $data = [
            'title' => 'Account',
            'role' => Role::all(),
        ];
        return view('content.account.create', $data);
    }

    public function store(Request $request)
    {
        checkingPermission('user_create');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|lowercase|unique:users,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:roles,name',
        ]);

        try {
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
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create account: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        checkingPermission('user_update');
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
        checkingPermission('user_update');
        $id = decrypt($id);
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|lowercase|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|exists:roles,name',
        ]);

        try {
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
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update account: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        checkingPermission('user_delete');
        $id = decrypt($id);
        $user = User::findOrFail($id);
        try {
            $this->deleteStoredFile($user->photo);
            $user->delete();

            return redirect()->route('master-data.account.index')->with('success', 'Account deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to delete account: ' . $e->getMessage()]);
        }
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
