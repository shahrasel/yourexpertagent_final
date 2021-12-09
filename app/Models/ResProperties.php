<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResProperties extends Model
{
    use HasFactory;
    protected $table = 'res_properties';

    public function getDaysBetweenDates($startTimeStamp,$endTimeStamp){
        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = $timeDiff/86400;  // 86400 seconds in one day

        return $numberDays = intval($numberDays);
    }
}
