<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    function index()
    {
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::all();

        
        $nil = NilaiPegawai::all();
        $nil_t = [];

        foreach($nil as $i=>$nii){
            $nil_t[$nii->id_pegawai][$nii->id_kriteria]=$nii->nilai;
        }
        // dd($nil_t);

        return view('admin.nilai', ['pegawai' => $pegawai, 'kriteria' => $kriteria,'nil'=>$nil_t]);
    }

    function save(Request $request)
    {
        // dd($request);
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::all();
        $nilpegawai = NilaiPegawai::all();
        foreach ($pegawai as $i => $pgw) {
            foreach ($kriteria as $j => $krt) {
                if ($nil = $request->get($pgw->id . ':' . $krt->id)) {
                    $npgw = $nilpegawai->where('id_pegawai','=',$pgw->id)->where('id_kriteria','=',$krt->id)->first();
                    if($npgw){
                        $npgw->nilai = $nil;
                        $npgw->save();
                    }else{
                        NilaiPegawai::create([
                            'id_pegawai'=>$pgw->id,
                            'id_kriteria'=>$krt->id,
                            'nilai'=>$nil
                        ]);
                    }
                }
            }
        }

        // dd($nilpegawai);
        return redirect()->route('nilai');
    }
}
