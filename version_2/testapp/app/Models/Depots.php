<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depots extends Model
{
    use HasFactory;
    protected $fillable = [
'GDE_DEPOT',
'GDE_LIBELLE',
    ];
}