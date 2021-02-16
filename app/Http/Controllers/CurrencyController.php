<?php

namespace App\Http\Controllers;

use App\Models\Currency\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function showAll()
    {
        return Currency::all();
    }
}
