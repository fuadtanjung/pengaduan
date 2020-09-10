<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    protected $table = 'usersses';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = [
        'nama_user','sk_user'
    ];


    public function informasi_pelaporan(){
        return $this->hasOne(Informasi_pelaporan::class);
    }
}
