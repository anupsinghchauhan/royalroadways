<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
use DB;

class DBBackupController extends Controller
{
    public function getBackup()
    {
        exit;
        //DB::table('user_types') ->where('id', 2)->update(['created_at' =>date('Y-m-d H:i:s')]);
        
        /*
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        // Create backup folder and set permission if not exist.
        $storageAt = storage_path() . "/app/backup/";
        if(!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }
        $command = "".env('DB_DUMP_PATH', 'mysqldump')." --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . $storageAt . $filename;
        $returnVar = NULL;
        $output = NULL;
        exec($command);
        */
        
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . storage_path() . "/app/backup/" . $filename;
        exec($command);
    }
}
