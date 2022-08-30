<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'city',
        'description',
        'nb_localite',
        'circonscription_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'circonscription_id' => 'integer',
    ];

    public function circonscription()
    {
        return $this->belongsTo(Circonscription::class);
    }


    public function localites()
    {
        return $this->hasMany(Localite::class);
    }
}
