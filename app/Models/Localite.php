<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
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
        'secteur_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'secteur_id' => 'integer',
    ];

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

   

    public function jeunes()
    {
        return $this->hasMany(Jeune::class);
    }
}
