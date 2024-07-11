<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsenceTypes;

class AbsenceTypesController extends Controller
{
    public function index()
    {
        $absenceTypes = AbsenceTypes::all();
        return response()->json($absenceTypes);
    }
}
