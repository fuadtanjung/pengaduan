<?php

namespace App\Http\Controllers;

use App\Urgensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UrgensiController extends Controller
{
    public function index(){
        return view('klasifikasi.urgensi');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_urgensi' => 'required:Urgensi ',
            'sk_urgensi' => 'required:Urgensi',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if ($validasi->passes()) {
            $urgensi = new Urgensi;
            $urgensi->nama_urgensi = $request->nama_urgensi;
            $urgensi->sk_urgensi = $request->sk_urgensi;

            if($urgensi->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Urgensi"));
            }
            else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Urgensi"));
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

    public function ajaxTable(){
        $urgensi =  DB::table('urgensis')->get();
        try {
            return Datatables::of($urgensi)
                ->addColumn('action', function ($userss) {
                    return "
                        <a href=\"#\" class=\"btn btn-outline-success btn-sm legitRipple\" id=\"edit\"><i class=\"icon-pencil\"></i> </a>
                        <a href=\"#\" class=\"btn btn-outline-danger btn-sm legitRipple\" id=\"delete\"><i class=\"icon-trash\"></i> </a>
                    ";
                })
                ->make(true);
        } catch (\Exception $e) {
        }
    }
    public function edit($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $urgensi = Urgensi::where('id_urgensi', $id)->first();
            $urgensi->nama_urgensi = $request->nama_urgensi;
            $urgensi->sk_urgensi = $request->sk_urgensi;

            if ($urgensi->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Urgensi :)"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Urgensi :("));
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
        $urgensi = Urgensi::where('id_urgensi', $id)->first();
        if($urgensi->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Urgensi :)"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Urgensi :("));
        }
    }

}
