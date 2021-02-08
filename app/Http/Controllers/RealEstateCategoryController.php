<?php

namespace App\Http\Controllers;

use App\Models\RealEstate\RealEstateCategory;
use Illuminate\Http\Request;

class RealEstateCategoryController extends Controller
{
    public function showAll()
    {
        return RealEstateCategory::all();
    }
}
