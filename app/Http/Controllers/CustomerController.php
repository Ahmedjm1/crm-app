<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
{
    $query = Customer::where('user_id', auth()->id());

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('phone', 'like', '%' . $request->search . '%');
        });
    }

    $customers = $query->get();

    return view('customers.index', compact('customers'));
}

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Customer::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        return redirect('/customers');
    }
    public function edit($id)
{
    $customer = Customer::findOrFail($id);
    return view('customers.edit', compact('customer'));
}

public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    $customer->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'notes' => $request->notes,
    ]);

    return redirect('/customers');
}

public function destroy($id)
{
    $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect('/customers');
}
}