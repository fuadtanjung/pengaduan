<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    public $timestamps = false;
    protected $fillable = [
        'nama_jenis','sk_jenis'
    ];

    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
