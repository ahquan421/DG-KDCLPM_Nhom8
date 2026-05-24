<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index() {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create() {
        return view('addresses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Address::create($data);
        return redirect()->route('addresses.index')->with('success', 'Them dia chi thanh cong');
    }

    public function edit($id) {
        $address = Address::findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, $id) {
        $address = Address::findOrFail($id);

        $request->validate([
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $address->update($request->all());
        return redirect()->route('addresses.index')->with('success', 'Cap nhat dia chi thanh cong');
    }

    public function destroy($id) {
        Address::destroy($id);
        return redirect()->route('addresses.index')->with('success', 'Xoa dia chi thanh cong');
    }

}
