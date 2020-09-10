<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prioritas extends Model
{
    protected $table = 'prioritas';
    protected $primaryKey = 'id_prioritas';
    public $timestamps = false;
    protected $fillable = [
        'nama_prioritas','sk_prioritas'
    ];

    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
