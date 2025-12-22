<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Order::create([
            'user_id' => Auth::id(),
            'total' => 0,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Order placed successfully');
    }
}
