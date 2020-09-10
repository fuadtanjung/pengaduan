<?php

namespace App\Http\Controllers;

use App\User;
use App\Userss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Validator;
class UserController extends Controller
{
    public function index(){
        return view('klasifikasi.user');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_user' => 'required:Userss ',
            'sk_user' => 'required:Userss',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if ($validasi->passes()) {
            $user = new Userss;
            $user->nama_user = $request->nama_user;
            $user->sk_user = $request->sk_user;

            if($user->save()){
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

    public function ajaxTable(){
        $userss =  DB::table('usersses')->get();
        try {
            return Datatables::of($userss)
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
            $userss = Userss::where('id_user', $id)->first();
            $userss->nama_user = $request->nama_user;
            $userss->sk_user = $request->sk_user;

            if ($userss->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data User :)"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data User :("));
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
        $userss = Userss::where('id_user', $id)->first();
        if($userss->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data User :)"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data User :("));
        }
    }

}
