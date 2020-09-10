<?php

namespace App\Http\Controllers;

use App\Informasi_pelaporan;
use Illuminate\Http\Request;

class RekapController extends Controller
{

    public function laporan($id){
        $status = "difasilitasi";
        $informasi_pelaporan = Informasi_pelaporan::where('status',$status)
        ->join ('tipes','informasi_pelaporans.tipe_id','=','tipes.id_tipe')
        ->join ('dampaks','informasi_pelaporans.dampak_id','=','dampaks.id_dampak')
        ->join ('jenis','informasi_pelaporans.jenis_id','=','jenis.id_jenis')
        ->join ('kategoris','informasi_pelaporans.kategori_id','=','kategoris.id_kategori')
        ->join ('petugas','informasi_pelaporans.petugas_id','=','petugas.id_petugas')
        ->join ('prioritas','informasi_pelaporans.prioritas_id','=','prioritas.id_prioritas')
        ->join ('urgensis','informasi_pelaporans.urgensi_id','=','urgensis.id_urgensi')
        ->join ('usersses','informasi_pelaporans.user_id','=','usersses.id_user')
        ->get();
        return view('penyelesaian.rekap', compact('informasi_pelaporan'));
    }

    public function semua(Request $request)
    {
        $mulai = $request->start;
        $akhir = $request->end;
        $status = "difasilitasi";
        if($request->filled('start') && $request->filled('end')){
            $informasi_pelaporan = Informasi_pelaporan::where('status',$status)
                ->join ('tipes','informasi_pelaporans.tipe_id','=','tipes.id_tipe')
                ->join ('dampaks','informasi_pelaporans.dampak_id','=','dampaks.id_dampak')
                ->join ('jenis','informasi_pelaporans.jenis_id','=','jenis.id_jenis')
                ->join ('kategoris','informasi_pelaporans.kategori_id','=','kategoris.id_kategori')
                ->join ('petugas','informasi_pelaporans.petugas_id','=','petugas.id_petugas')
                ->join ('prioritas','informasi_pelaporans.prioritas_id','=','prioritas.id_prioritas')
                ->join ('urgensis','informasi_pelaporans.urgensi_id','=','urgensis.id_urgensi')
                ->join ('usersses','informasi_pelaporans.user_id','=','usersses.id_user')
                ->whereBetween('tgl_selesai', [$mulai, $akhir])
                ->get();
        }else{
            $informasi_pelaporan = Informasi_pelaporan::where('status',$status)
                ->join ('tipes','informasi_pelaporans.tipe_id','=','tipes.id_tipe')
                ->join ('dampaks','informasi_pelaporans.dampak_id','=','dampaks.id_dampak')
                ->join ('jenis','informasi_pelaporans.jenis_id','=','jenis.id_jenis')
                ->join ('kategoris','informasi_pelaporans.kategori_id','=','kategoris.id_kategori')
                ->join ('petugas','informasi_pelaporans.petugas_id','=','petugas.id_petugas')
                ->join ('prioritas','informasi_pelaporans.prioritas_id','=','prioritas.id_prioritas')
                ->join ('urgensis','informasi_pelaporans.urgensi_id','=','urgensis.id_urgensi')
                ->join ('usersses','informasi_pelaporans.user_id','=','usersses.id_user')
                ->get();
        }
        return view('penyelesaian.rekap', compact('informasi_pelaporan'));
    }

}
