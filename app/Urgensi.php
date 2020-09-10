<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urgensi extends Model
{
    protected $table = 'urgensis';
    protected $primaryKey = 'id_urgensi';
    public $timestamps = false;
    protected $fillable = [
        'nama_urgensi','sk_urgensi'
    ];

    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
