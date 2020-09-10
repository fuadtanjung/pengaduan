<?php

namespace App\Http\Controllers;

use App\Dampak;
use App\Jenis;
use App\Kategori;
use App\Petugas;
use App\Prioritas;
use App\Tipe;
use App\Urgensi;
use App\Userss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Informasi_pelaporan;

class PenyelesaianController extends Controller
{

    public function index(){
        return view('penyelesaian.laporan');
    }

    public function ajaxtable(){
        $informasi_pelaporan =  Informasi_pelaporan::with('Tipe')
            ->with('Kategori')
            ->with('Prioritas')
            ->with('Petugas')
            ->with('Jenis')
            ->with('Urgensi')
            ->with('Userss')
            ->with('Dampak')
            ->where('status','difasilitasi')
            ->get();
        try {
            return Datatables::of($informasi_pelaporan)
                ->addColumn('action', function ($informasi_pelaporan) {
                    return "
                        <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\"><i class=\"icon-eye\"></i> </a>
                         <a href=\"#\" class=\"btn btn-outline-warning btn-sm legitRipple\" id=\"print\"><i class=\"icon-printer-text4\"></i></a>
                    ";
                })
                ->make(true);
        } catch (\Exception $e) {

        }
    }


    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_pengguna' => 'required:informasi_pelaporan',
            'kontak_pengguna' => 'required:informasi_pelaporan',
            'deskripsi' => 'required:informasi_pelaporan',
            'waktu_pelaporan' => 'required:informasi_pelaporan',
            'media_pelaporan' => 'required:informasi_pelaporan',
            'tipe' => 'required:informasi_pelaporan',
            'kategori' => 'required:informasi_pelaporan',
            'user' => 'required:informasi_pelaporan',
            'jenis' => 'required:informasi_pelaporan',
            'urgensi' => 'required:informasi_pelaporan',
            'dampak' => 'required:informasi_pelaporan',
            'prioritas' => 'required:informasi_pelaporan',
            'petugas' => 'required:informasi_pelaporan',
            'keterangan' => 'required:informasi_pelaporan',
            'solusi' => 'required:informasi_pelaporan',
            'konfirmasi' => 'required:informasi_pelaporan',
        ], $pesan);
    }

    public function input(Request $request)
    {
        $date = date('Y-m_d');
        $status = 'difasilitasi';
        $validasi = $this->validasiData($request->all());
        if ($validasi->passes()) {
            $informasi_pelaporan = new informasi_pelaporan;
            $informasi_pelaporan->nama_pengguna = $request->nama_pengguna;
            $informasi_pelaporan->kontak_pengguna = $request->kontak_pengguna;
            $informasi_pelaporan->media_pelaporan = $request->media_pelaporan;
            $informasi_pelaporan->deskripsi = $request->deskripsi;
            $informasi_pelaporan->waktu_pelaporan= $request->waktu_pelaporan;
            $informasi_pelaporan->kontak_pengguna = $request->kontak_pengguna;
            $informasi_pelaporan->kategori_id = $request->kategori;
            $informasi_pelaporan->tipe_id = $request->tipe;
            $informasi_pelaporan->user_id = $request->user;
            $informasi_pelaporan->urgensi_id = $request->urgensi;
            $informasi_pelaporan->prioritas_id = $request->prioritas;
            $informasi_pelaporan->jenis_id = $request->jenis;
            $informasi_pelaporan->dampak_id = $request->dampak;
            $informasi_pelaporan->petugas_id = $request->petugas;
            $informasi_pelaporan->keterangan = $request->keterangan;
            $informasi_pelaporan->solusi = $request->solusi;
            $informasi_pelaporan->status = $status;
            $informasi_pelaporan->status_pengguna = $request->konfirmasi;
            $informasi_pelaporan->tgl_pemuktahiran = $date;
            $informasi_pelaporan->tgl_selesai = $date;

            $informasi_pelaporan->save();
            if ($informasi_pelaporan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Informasi :)"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Informasi :("));
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

    public function listKategori(){
        $kategori = Kategori::all();
        return json_encode($kategori);
    }
    public function listTipe(){
        $tipe = Tipe::all();
        return json_encode($tipe);
    }
    public function listUser(){
        $User = Userss::all();
        return json_encode($User);
    }
    public function listUrgensi(){
        $urgensi = Urgensi::all();
        return json_encode($urgensi);
    }
    public function listPrioritas(){
        $prioritas = Prioritas::all();
        return json_encode($prioritas);
    }
    public function listJenis(){
        $jenis = Jenis::all();
        return json_encode($jenis);
    }
    public function listDampak(){
        $dampak = Dampak::all();
        return json_encode($dampak);
    }
    public function listPetugas(){
        $petugas = Petugas::all();
        return json_encode($petugas);
    }
}
