<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'hour', 'confirm', 'user_id', 'service'];

    public const SERVICE_CORTE = 1;
    public const SERVICE_BARBA = 2;
    public const SERVICE_COMPLETO = 3;
    public const SERVICE_DURATIONS = [
        self::SERVICE_CORTE => 30,
        self::SERVICE_BARBA => 30,
        self::SERVICE_COMPLETO => 60,
    ];
    public const SERVICE_NAMES = [
        self::SERVICE_CORTE => 'Corte',
        self::SERVICE_BARBA => 'Barba',
        self::SERVICE_COMPLETO => 'Completo',
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public static function rules(){
        return [
            'hour' => 'required',
            'day' => 'required | date_format:"Y-m-d"',
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
