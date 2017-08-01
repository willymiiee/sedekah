<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sedekah extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nominal', 'notes', 'phone', 'name', 'email', 'payment'
    ];
}
