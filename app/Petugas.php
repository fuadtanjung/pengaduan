<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $timestamps = false;
    protected $fillable = [
        'in_petugas'
    ];

    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
