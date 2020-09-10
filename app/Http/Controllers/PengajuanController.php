<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Informasi_pelaporan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Kategori;
use App\Tipe;
use App\Userss;
use App\Urgensi;
use App\Prioritas;
use App\Jenis;
use App\Dampak;
use App\Petugas;

class PengajuanController extends Controller
{

    public function index(){
        return view('pengajuan.index');
    }

    public function ajaxTable(){
       $informasi_pelaporan =  DB::table('informasi_pelaporans')
           ->where('status','ditangani')
           ->orWhere('status','diajukan')->get();
        try {
            return Datatables::of($informasi_pelaporan)
                ->addColumn('action', function ($informasi) {
                    return "
                        <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\"><i class=\"icon-pencil\"></i> </a>
                        <a href=\"#\" class=\"btn btn-outline-primary btn-sm legitRipple\" id=\"change\"><i class=\"icon-power-off\"></i></a>
                        <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\"><i class=\"icon-trash\"></i> </a>
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


    public function edit($id, Request $request)
    {
        $validasi = $this->validasiData($request->all());
        $status = 'difasilitasi';
        if ($validasi->passes()) {
            $informasi_pelaporan = Informasi_pelaporan::where('id_pelaporan', $id)->first();
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
            $informasi_pelaporan->tgl_pemuktahiran = date('Y-m-d');
            $informasi_pelaporan->tgl_selesai = date('Y-m-d');
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

    public function delete($id){
        $informasi_pelaporan = Informasi_pelaporan::where('id_pelaporan', $id)->first();
        if($informasi_pelaporan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Informasi :)"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Informasi :("));
        }
    }

    public function changeStatus($id){
        $informasi_pelaporan = Informasi_pelaporan::where('id_pelaporan', $id)->first();
        if($informasi_pelaporan->status == "ditangani"){
            $informasi_pelaporan->status = "diajukan";
            $informasi_pelaporan->update();
        }else{
            $informasi_pelaporan->status = "ditangani";
            $informasi_pelaporan->update();
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
