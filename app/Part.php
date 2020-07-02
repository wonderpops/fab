<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public static function newest(){
        return static::orderBy('created_at', 'desc')->get();
    }

    public static function on_storage() {
        return static::where('status', 'На складе')->orderBy('created_at', 'desc')->get();
    }

    public static function sold() {
        return static::where('status', 'Продана')->orderBy('created_at', 'desc')->get();
    }
}
