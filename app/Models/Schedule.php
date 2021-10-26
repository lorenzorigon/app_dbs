<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $start_at
 * @property string $end_at
 * @property boolean $confirmed
 * @property int $user_id
 * @property int $service
 * @property string $created_at
 * @property string $updated_at
 */
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['start_at', 'end_at', 'confirmed', 'user_id', 'service'];

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
            'start_at_hour' => 'required',
            'start_at_day' => 'required | date_format:"Y-m-d"',
            'service' => 'required',
        ];
    }

    public static function feedback(){
        return [
            'start_at_hour.required' => 'Selecione um Horário!',
            'start_at_day.required' => 'Selecione uma data!',
            'start_at_day.date_format' => 'Informe uma data válida!',
            'service.required' => 'Selecione um serviço!'
        ];
    }
}
