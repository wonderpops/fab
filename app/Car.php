<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public static function newest(){
        return static::orderBy('created_at', 'desc')->get();
    }

    public static function disassembling() {
        return static::where('status', 'Разбирается')->get();
    }

    public static function disassembled() {
        return static::where('status', 'Разобрана')->get();
    }
}
