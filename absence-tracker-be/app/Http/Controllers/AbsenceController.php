<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::all();
        return response()->json($absences);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'dates' => 'required|array|size:2',
                'dates.*' => 'required|date',
                'type' => 'required|exists:absence_types,type',
            ]);

            $type = $request->input('type');
            $dates = $request->input('dates');

            $start_date = Carbon::parse($dates[0])->setTimezone('Europe/Sarajevo');
            $end_date = Carbon::parse($dates[1])->setTimezone('Europe/Sarajevo');

            $absences = [];

            for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
                $absences[] = Absence::create([
                    'date' => $date->format('Y-m-d'),
                    'type' => $type,
                ]);
            }

            return response()->json($absences, 201);
        } catch (\Exception $e) {
            Log::error('Error storing absence: ' . $e->getMessage());
            return response()->json(['message' => 'Došlo je do greške prilikom pohranjivanja odsutnosti'], 500);
        }
    }



    public function archive()
    {
        try {
            $absences = Absence::all();

            if ($absences->isEmpty()) {
                return response()->json(['message' => 'Nema podataka za arhiviranje'], 200);
            }

            foreach ($absences as $absence) {
                DB::table('archive')->insert([
                    'date' => $absence->date,
                    'type' => $absence->type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Absence::truncate();

            DB::commit();

            return response()->json(['message' => 'Podaci su arhivirani i izostanci su uspješno izbrisani']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error archiving data: ' . $e->getMessage());
            return response()->json(['message' => 'Došlo je do greške prilikom arhiviranja podataka'], 500);
        }
    }

    public function show($id)
    {
        $absence = Absence::find($id);
        if ($absence) {
            return response()->json($absence);
        } else {
            return response()->json(['message' => 'Odsustvo nije pronađeno'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $absence = Absence::find($id);
        if ($absence) {
            $absence->update($request->all());
            return response()->json($absence);
        } else {
            return response()->json(['message' => 'Odsustvo nije pronađeno'], 404);
        }
    }

    public function destroy($id)
    {
        $absence = Absence::find($id);
        if ($absence) {
            $absence->delete();
            return response()->json(['message' => 'Odsustvo izbrisano']);
        } else {
            return response()->json(['message' => 'Odsustvo nije pronađeno'], 404);
        }
    }
}
