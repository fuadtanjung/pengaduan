<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(){
        return view('klasifikasi.kategori');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_kategori' => 'required:Kategori ',
            'sk_kategori' => 'required:Kategori',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if ($validasi->passes()) {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->sk_kategori = $request->sk_kategori;

            if($kategori->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Kategori"));
            }
            else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Kategori"));
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
        $kategori =  DB::table('kategoris')->get();
        try {
            return Datatables::of($kategori)
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
            $kategori = Kategori::where('id_kategori', $id)->first();
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->sk_kategori = $request->sk_kategori;

            if ($kategori->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Kategori :)"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Kategori :("));
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
        $kategori = Kategori::where('id_kategori', $id)->first();
        if($kategori->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Kategori :)"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Kategori :("));
        }
    }

}
