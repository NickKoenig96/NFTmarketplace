<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $with = ['nft'];

    protected $fillable = [
        'nft_id',
        'user_id',
        'text',
    ];


    public function nft(){
        return $this->belongsTo(\App\Models\Nft::class);
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function time_elapsed($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60  =>  'month',
                        24 * 60 * 60  =>  'day',
                            60 * 60  =>  'hour',
                                    60  =>  'minute',
                                    1  =>  'second'
                    );
        $a_plural = array( 'year'   => 'years',
                        'month'  => 'months',
                        'day'    => 'days',
                        'hour'   => 'hours',
                        'minute' => 'minutes',
                        'second' => 'seconds'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
    
}
