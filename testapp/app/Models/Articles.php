<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected $table = 'articles';
    public function choix_cat1()
    {
        return $this->hasMany(Choix_Cat::class, 'CC_CODE', 'GA_FAMILLENIV1');

    }

    public function choix_cat2()
    {
        return $this->hasMany(Choix_Cat::class, 'CC_CODE', 'GA_FAMILLENIV2');

    }

    public function choix_cat3()
    {
        return $this->hasMany(Choix_Cat::class, 'CC_CODE', 'GA_FAMILLENIV3');

    }
}