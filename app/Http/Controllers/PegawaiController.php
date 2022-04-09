<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    function index(){
        $pegawai = Pegawai::all();
        return view('admin.pegawai',['pegawais'=>$pegawai]);
    }

    function add(Request $request){
        // dd($request);
        $cre = $request->validate([
            'nama'=>'required',
            'umur'=>'required',
            'jk'=>'required',
        ]);

        Pegawai::create($cre);

        return redirect()->back();
    }

    function show_edit($pegawaiid){
        $pegawai = Pegawai::find($pegawaiid);
        

        return view('admin.edit_pegawai',['pegawai'=>$pegawai]);
    }

    function save(Request $request,$pegawaiid){
        $pegawai = Pegawai::find($pegawaiid);
        $cre = $request->validate([
            'nama'=>'required',
            'umur'=>'required',
            'jk'=>'required',
        ]);
        $pegawai->fill($cre)->save();
        return redirect()->route('pegawai')->with('message','pegawai telah di edit');

    }

    function delete($pegawaiid){
        $pegawai = Pegawai::findOrFail($pegawaiid);
        $pegawainame = $pegawai->name;
        $pegawai->delete();

        return redirect()->route('pegawai')->with('message',$pegawainame.' has been successfully deleted');
    }
}
