<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Customer;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function index()
    {
        $followUps = FollowUp::where('user_id', auth()->id())
            ->with('customer')
            ->orderBy('reminder_date', 'asc')
            ->get();

        return view('followups.index', compact('followUps'));
    }

    public function create()
    {
        $customers = Customer::where('user_id', auth()->id())->get();
        return view('followups.create', compact('customers'));
    }

    public function store(Request $request)
    {
        FollowUp::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'note' => $request->note,
            'reminder_date' => $request->reminder_date,
        ]);

        return redirect('/followups');
    }
}
