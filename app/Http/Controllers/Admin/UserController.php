<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'usertype' => 'required|in:user,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm user thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'usertype' => 'required|in:user,admin', 
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'usertype' => $request->usertype,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6|confirmed']);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật user thành công.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->usertype == 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa người dùng admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa user thành công.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $addresses = Address::where('user_id', $id)->get(); 
        $orders = Order::where('customer_id', $id)->get();

        return view('admin.users.show', compact('user', 'addresses', 'orders'));
    }
}
