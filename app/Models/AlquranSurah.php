<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlquranSurah extends Model
{
    use HasFactory;

    protected $table = 'alquran_surah';
    protected $guarded = [];
    public $timestamps = false;

    public function alquransurahs()
    {
        return $this->belongsTo(AlquranSurah::class);
    }
}


