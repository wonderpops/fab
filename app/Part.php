<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public static function on_storage() {
        return static::where('status', 'На складе')->get();
    }

    public static function sold() {
        return static::where('status', 'Продана')->get();
    }
}
