<?php

namespace App\Http\Controllers;

use App\Informasi_pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Validator;

class PengaduanController extends Controller
{
    public function index(){
        return view('index');
    }

    protected function  validasiData($data)
    {
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_pengguna' => 'required:informasi_pelaporan',
            'kontak_pengguna' => 'required:informasi_pelaporan',
            'deskripsi' => 'required:informasi_pelaporan',
        ], $pesan);
    }

    public function input(Request $request){

        $validasi = $this->validasiData($request->all());
        $media = 'aplikasi';
        $status = 'diajukan';
        $no = Informasi_pelaporan::max('id_pelaporan');
        $tiket = date('Y') . sprintf("%03s", $no);
        if ($validasi->passes()) {
            $informasi_pelaporan = new Informasi_pelaporan;
            $informasi_pelaporan->no_tiket = $tiket;
            $informasi_pelaporan->nama_pengguna = $request->nama_pengguna;
            $informasi_pelaporan->kontak_pengguna = $request->kontak_pengguna;
            $informasi_pelaporan->deskripsi = $request->deskripsi;
            $informasi_pelaporan->status = $status;
            $informasi_pelaporan->media_pelaporan = $media;
            $informasi_pelaporan->waktu_pelaporan = date('Y-m-d');
            if($informasi_pelaporan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Pengaduan"));
            }
            else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Pengaduan"));
            }
        }else{
            $msg = $validasi->getMessageBag()->messages();
            $err = array();
            foreach ($msg as $key=>$item) {
                $err[] = $item[0];
            }
            return json_encode(array("error"=>$err));
        }
    }
}
