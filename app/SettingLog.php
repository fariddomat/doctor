<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingLog extends Model
{
    protected $guarded=[];

    public static function log($type, $user_id, $log, $url)
    {
        SettingLog::create([
            'type'=>$type,
            'user_id'=>$user_id,
            'log'=>$log,
            'url'=>$url,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
