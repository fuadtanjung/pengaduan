@extends('layouts.template')
@section('menu')

        <ul class="sidebar-menu">
            <li class="treeview">`
                <a href="{{ url('admin')}}">
                    <i class="icon icon-info-circle s-24"></i> <span>Daftar Pengaduan</span>
                </a>
                <a href="{{ url('laporan')}}">
                    <i class="icon icon-info-circle s-24"></i> <span>Daftar Laporan</span>
                </a>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="icon icon-account_box s-24"></i> <span>Klasifikasi</span>
                    <i class=" icon-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('user') }}"><i class="icon icon-minus-circle"></i>User</a></li>
                    <li><a href="{{ url('dampak') }}"><i class="icon icon-minus-circle"></i>Dampak</a></li>
                    <li><a href="{{ url('jenis') }}"><i class="icon icon-minus-circle"></i>Jenis</a></li>
                    <li><a href="{{ url('petugas') }}"><i class="icon icon-minus-circle"></i>Petugas</a></li>
                    <li><a href="{{ url('urgensi') }}"><i class="icon icon-minus-circle"></i>Urgensi</a></li>
                    <li><a href="{{ url('prioritas') }}"><i class="icon icon-minus-circle"></i>Prioritas</a></li>
                    <li><a href="{{ url('tipe') }}"><i class="icon icon-minus-circle"></i>Tipe</a></li>
                    <li><a href="{{ url('kategori') }}"><i class="icon icon-minus-circle"></i>Kategori</a></li>
                </ul>
            </li>
        </ul>
@endsection
