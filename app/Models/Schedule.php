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

    public static function rules(){
        return [
            'hour' => 'required',
            'day' => 'required | date_format:"d/m/Y"',
            'service' => 'required',
        ];
    }

    public static function feedback(){
        return [
            'hour.required' => 'Selecione um Horário!',
            'day.required' => 'Selecione uma data!',
            'day.date_format' => 'Informe uma data válida!',
            'service.required' => 'Selecione um serviço!'
        ];
    }
}
