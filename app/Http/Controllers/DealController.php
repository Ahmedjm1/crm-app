<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Customer;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
{
    $query = Deal::where('user_id', auth()->id())
        ->with('customer');

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhereHas('customer', function ($c) use ($request) {
                  $c->where('name', 'like', '%' . $request->search . '%');
              });
        });
    }

    $deals = $query->get();

    return view('deals.index', compact('deals'));
}

    public function create()
    {
        $customers = Customer::where('user_id', auth()->id())->get();
        return view('deals.create', compact('customers'));
    }

    public function store(Request $request)
    {
        Deal::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'title' => $request->title,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect('/deals');
    }
    public function edit($id)
{
    $deal = Deal::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $customers = Customer::where('user_id', auth()->id())->get();

    return view('deals.edit', compact('deal', 'customers'));
}

public function update(Request $request, $id)
{
    $deal = Deal::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $deal->update([
        'customer_id' => $request->customer_id,
        'title' => $request->title,
        'status' => $request->status,
        'price' => $request->price,
    ]);

    return redirect('/deals');
}

public function destroy($id)
{
    $deal = Deal::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $deal->delete();

    return redirect('/deals');
}
}