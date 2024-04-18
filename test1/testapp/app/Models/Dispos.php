<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispos extends Model
{
    use HasFactory;
    protected $table = 'dispos';

    /**
     * Relation one-to-one ou many-to-one avec la table Article.
     */
    public function articles()
    {
        return $this->belongsTo(Articles::class, 'GQ_ARTICLE', 'GA_CODEARTICLE');
    }

    /*
     * Relation many-to-one avec la table Depots.
     */
    
    public function depots()
    {
        return $this->belongsTo(Depots::class, 'GQ_DEPOT', 'GDE_DEPOT');
    }
}