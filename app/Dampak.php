<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dampak extends Model
{
    protected $table = 'dampaks';
    protected $primaryKey = 'id_dampak';
    public $timestamps = false;
    protected $fillable = [
        'nama_dampak','sk_dampak'
    ];

    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
