<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeune extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'city',
        'fonction',
        'is_married',
        'is_water_baptism',
        'is_spirit_baptism',
        'birthday',
        'date_water_baptism',
        'date_spirit_baptism',
        'sexe',
        'localite_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_married' => 'boolean',
        'is_water_baptism' => 'boolean',
        'is_spirit_baptism' => 'boolean',
        'birthday' => 'date',
        'date_water_baptism' => 'date',
        'date_spirit_baptism' => 'date',
        'localite_id' => 'integer',
    ];

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

   
}
