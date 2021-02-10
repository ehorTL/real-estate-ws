<?php

namespace App\Http\Controllers;

use App\Models\RealEstate\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function showAll(Request $request)
    {
        return ContractType::all();
    }
}
