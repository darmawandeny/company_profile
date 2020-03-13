<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class Artikel_controller extends Controller
{
    public function index(){
    	$title = 'List Artikel';
    	$artikel = \DB::table('artikel')->get();

    	return view('admin.artikel.artikel_index',compact('title','artikel'));
    }

    public function store(Request $request){
    	$judul = $request->judul;
    	$isi = $request->isi;
    	$tanggal = date("Y-m-d");

    	\DB::table('artikel')->insert([
    		'judul'=>$judul,
    		'isi'=>$isi,
    		'tanggal'=>$tanggal
    	]);

    	Session::flash('pesan','Data berhasil ditambah');
    	return redirect('admin/artikel');
    }

    public function edit($artikel_id){
    	$title = 'Data berhasil di edit';
    	$at = \DB::table('artikel')->where('artikel_id',$artikel_id)->first();

    	return view('admin.artikel.artikel_edit',compact('title','at'));
    }

    public function update(Request $request, $artikel_id){
    	$judul = $request->judul;
    	$isi = $request->isi;
    	$tanggal = date("Y-m-d");

        $file = $request->file('foto');
     
        /*
                // nama file
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';
         
                // ekstensi file
            echo 'File Extension: '.$file->getClientOriginalExtension();
            echo '<br>';
         
                // real path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';
         
                // ukuran file
            echo 'File Size: '.$file->getSize();
            echo '<br>';
         
                // tipe mime
            echo 'File Mime Type: '.$file->getMimeType();
         
                // isi dengan nama folder tempat kemana file diupload

        */

        $tujuan_upload = 'public';
        $file->move($tujuan_upload,$file->getClientOriginalName());

    	\DB::table('artikel')->where('artikel_id',$artikel_id)->update([
    		'judul'=>$judul,
    		'isi'=>$isi,
    		'tanggal'=>$tanggal,
            'foto'=>$file->getClientOriginalName(),
    	]);

    	Session::flash('pesan','Data berhasil di update');
    	return redirect('admin/artikel');
    }

    public function delete($artikel_id){
    	\DB::table('artikel')->where('artikel_id',$artikel_id)->delete();

    	Session::flash('pesan','Data berhasil dihapus');
    	return redirect('admin/artikel');
    }
}
