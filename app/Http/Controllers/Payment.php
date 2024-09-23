<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Snap;

class Payment extends Controller
{
    //
    public function index($snapToken) {
        return view('payment.index', compact('snapToken'));
    }
}
