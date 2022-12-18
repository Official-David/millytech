<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    public function deactivateTrading()
    {
        try {
            $currentValue = config('system.trading');
            $newValue = $currentValue == '1' ? '0' : '1';
            file_put_contents(
                app()->environmentFilePath(),
                str_replace(
                    "SYSTEM_TRADING=" . $currentValue,
                    "SYSTEM_TRADING=" . $newValue,
                    file_get_contents(app()->environmentFilePath())
                )
            );
            if (app()->environment() != 'local') {
                Artisan::call('optimize');
            }
            $message = $currentValue ? 'Trading Deactivated successfully' : 'Trading system is back online';
            return response()->json([
                'message' => $message
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'message' => 'Failed to update trading status'
            ], 400);
        }
    }
}
