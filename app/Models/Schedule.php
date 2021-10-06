<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'hour', 'confirm', 'user_id', 'service'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
