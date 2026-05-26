<?php

namespace App\Http\Controllers;

use App\Models\ProgressState;
use App\Models\ProgressLog;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{
    /**
     * Render the public progress report dashboard.
     */
    public function index()
    {
        $state = ProgressState::getSingle();
        return view('progress-report', compact('state'));
    }

    /**
     * Return progress data as JSON for live updates.
     */
    public function data()
    {
        $state = ProgressState::getSingle();
        
        // Format timestamps to H:i:s or '-' if null
        $formattedTime = function ($time) {
            if (!$time) return '-';
            return \Carbon\Carbon::parse($time)->timezone('Asia/Jakarta')->format('H:i:s');
        };

        $data = $state->toArray();
        
        // Append formatted times
        foreach ($data as $key => $value) {
            if (str_ends_with($key, '_time')) {
                $data[$key . '_formatted'] = $formattedTime($value);
            }
        }

        // Include updated_at formatted
        $data['updated_at_formatted'] = $state->updated_at ? $state->updated_at->timezone('Asia/Jakarta')->format('H:i:s') : '-';

        return response()->json($data);
    }

    /**
     * Render the playback/animation page with logged history.
     */
    public function playback()
    {
        $state = ProgressState::getSingle();
        $logs = ProgressLog::orderBy('created_at', 'asc')->get()->map(function ($log) {
            $formattedTime = function ($time) {
                if (!$time) return '-';
                return \Carbon\Carbon::parse($time)->timezone('Asia/Jakarta')->format('H:i:s');
            };

            $logState = $log->state;
            foreach ($logState as $key => $value) {
                if (str_ends_with($key, '_time')) {
                    $logState[$key . '_formatted'] = $formattedTime($value);
                }
            }

            return [
                'id' => $log->id,
                'created_at' => $log->created_at->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'time_formatted' => $log->created_at->timezone('Asia/Jakarta')->format('H:i'),
                'minute_key' => $log->created_at->timezone('Asia/Jakarta')->format('H:i'), // for minute-by-minute playback
                'state' => $logState
            ];
        });

        return view('progress-playback', compact('logs', 'state'));
    }
}
