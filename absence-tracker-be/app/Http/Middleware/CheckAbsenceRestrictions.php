<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Absence;
use Carbon\Carbon;

class CheckAbsenceRestrictions
{
    public function handle(Request $request, Closure $next): Response
    {
        $dates = $request->dates;
        $type = $request->type;

        if (is_array($dates) && count($dates) == 2) {
            $start_date = Carbon::parse($dates[0])->setTimezone('Europe/Sarajevo');
            $end_date = Carbon::parse($dates[1])->setTimezone('Europe/Sarajevo');

            if ($type == 'sick') {
                $sickLeaveCount = Absence::where('type', 'sick')
                    ->whereYear('date', $start_date->year)
                    ->whereMonth('date', $start_date->month)
                    ->count();

                $daysInRange = $start_date->diffInDays($end_date) + 1;

                if ($sickLeaveCount + $daysInRange > 7) {
                    return response()->json(['message' => 'Ne možete prijaviti više od 7 dana bolovanja u mjesecu'], 400);
                }
            }

            if ($type == 'vacation') {
                for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
                    if ($date->isWeekend()) {
                        return response()->json(['message' => 'Ne možete prijaviti godišnji odmor vikendom'], 400);
                    }
                }
            }
        }

        return $next($request);
    }
}
