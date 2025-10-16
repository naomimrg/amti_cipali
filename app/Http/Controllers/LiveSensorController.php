<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LiveSensorController extends Controller
{
    public function history(Request $req)
    {
        $id     = (int) $req->query('id_sensor');
        $window = (int) $req->query('window', 60); 
        $step   = (int) $req->query('step', 3);   

        if (!$id) return response()->json(['error' => 'id_sensor required'], 422);

        $sensor = DB::table('sensor')->where('id', $id)->first();
        $unit   = $sensor->satuan ?? '';

        $to   = now();
        $from = $to->copy()->subSeconds($window);

        try {
            $rows = DB::select("
                SELECT
                  time_bucket(?::interval, \"time\") AS t,
                  avg(value) AS value
                FROM log_data
                WHERE id_sensor = ? AND \"time\" BETWEEN ? AND ?
                GROUP BY t
                ORDER BY t ASC
            ", [ $step.' seconds', $id, $from, $to ]);
        } catch (\Throwable $e) {
            $rows = DB::select("
                SELECT
                  to_timestamp(floor(extract(epoch from \"time\") / ?) * ?) AS t,
                  avg(value) AS value
                FROM log_data
                WHERE id_sensor = ? AND \"time\" BETWEEN ? AND ?
                GROUP BY 1
                ORDER BY 1 ASC
            ", [ $step, $step, $id, $from, $to ]);
        }

        $items = collect($rows)
            ->map(fn($r) => [
                'datetime' => Carbon::parse($r->t)->format('Y-m-d H:i:s'),
                'value'    => isset($r->value) ? round((float)$r->value, 6) : null,
                'satuan'   => $unit,
            ])
            ->take(intval($window / $step))
            ->values()
            ->all();

        return response()->json([
            'items' => $items,
            'unit'  => $unit,
            'from'  => $from->format('Y-m-d H:i:s'),
            'to'    => $to->format('Y-m-d H:i:s'),
            'step'  => $step,
        ]);
    }
}
