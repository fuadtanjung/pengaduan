<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .letak{

            margin-top: 20px;
            margin-left: 1%;
            margin-right: 1%;

        }
    </style>

</head>
<body>
<br><br>

<table style="margin-left: 100px; font-size: 10px" width="85%">
    <th>
        <img src="{{ url('assets/images/lpse.png') }}" width="90" height="40"> &nbsp;
        <a style="text-align: center;margin-left: 200px">Formulir Pencatatan Gangguan/Permasalahan dan Permintaan Layanan</a></th>
    <th style="font-size: 7px"> Priode :...............................<br>
        Lpse: Kota Padang</th>
</table>

<style type="text/css" media="print">
    @page {
        size: landscape;
    }
</style>

<div class="letak">
    <div >
        <table  class="table-sm" >
            <thead class="table-info" style="font-size: 9px;text-align: center">
            <tr>
                <th rowspan="4">No Tiket</th>
                <th colspan="4">informasi pelaporan</th>
                <th rowspan="4">deskripsi</th>
                <th colspan="7">klasifikasi</th>
                <th colspan="4">informasi penanganan</th>
                <th colspan="4">informasi penyelesaian</th>
            </tr>
            <tr >
                <th rowspan="3">nama <br> pengguna</th>
                <th rowspan="3">kontak <br> pengguna</th>
                <th rowspan="3">media <br> pelaporan <br> (email,telp<br>,surat,dll</th>
                <th rowspan="3">waktu <br> pelaporan</th>
                <th rowspan="1">tipe</th>
                <th rowspan="1">kategori</th>
                <th rowspan="1">user</th>
                <th rowspan="1">jenis</th>
                <th rowspan="1">urgensi</th>
                <th rowspan="1">dampak</th>
                <th rowspan="1">Prioritas</th>
                <th rowspan="3">nama petugas</th>
                <th rowspan="3">status</th>
                <th rowspan="3">keterangan</th>
                <th rowspan="3">tanggal <br> pemuktahiran</th>
                <th rowspan="3">solusi</th>
                <th rowspan="3">tanggal <br>penyelesaian</th>
                <th rowspan="3">status <br>konfirmasi <br>kepada <br>pengguna</th>
            </tr>

            <tr >
                <th>Gangguan,<br>Masalah,<br>Permintaan Layanan</th>
                <th>Teknis,<br>Non teknis</th>
                <th>Panitia,<br>Penyedia,PPK,<br> Auditor,Publik <br> Lainnya</th>
                <th>Hardware,<br>Software,<br>Prosedur,Lain- <br> lainnya</th>
                <th>Mendesak,<br>Tidak Mendesak</th>
                <th>Besar,<br>Sedang,<br>Kecil</th>
                <th>Tinggi,<br>Menengah,<br>Rendah</th>
            </tr>
            <tr>
                <th>G,M,P</th>
                <th>T,N</th>
                <th>P,Py,PPK,A,L</th>
                <th>H,S,U,P,L</th>
                <th>M,T</th>
                <th>B,S,K</th>
                <th>T,M,R</th>
            </tr>
            </thead>

            <tbody>
            @foreach($informasi_pelaporan as $data)
                <tr style="font-size: 12px;text-align: center;">
                    <td>{{ $data->no_tiket }}</td>
                    <td>{{ $data->nama_pengguna }}</td>
                    <td>{{ $data->kontak_pengguna }}</td>
                    <td>{{ $data->media_pelaporan }}</td>
                    <td>{{ $data->waktu_pelaporan }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td>{{ $data->sk_tipe}}</td>
                    <td>{{ $data->sk_kategori }}</td>
                    <td>{{ $data->sk_user }}</td>
                    <td>{{ $data->sk_jenis }}</td>
                    <td>{{ $data->sk_urgensi }}</td>
                    <td>{{ $data->sk_dampak }}</td>
                    <td>{{ $data->sk_prioritas }}</td>
                    <td>{{ $data->in_petugas }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->tgl_pemuktahiran }}</td>
                    <td>{{ $data->solusi }}</td>
                    <td>{{ $data->tgl_selesai }}</td>
                    <td>{{ $data->status_pengguna }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>


<script>
    window.onload = function() { window.print(); }
</script>

</body>
</html>
