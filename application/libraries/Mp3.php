<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mp3
{
    public function getDuration($path)
    {
        $time = exec("ffmpeg -i " . escapeshellarg($path) . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
        list($hms, $milli) = explode('.', $time);
        list($hours, $minutes, $seconds) = explode(':', $hms);
        $total_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;
        return $total_seconds;
    }
}