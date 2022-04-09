<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\NilaiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){

        $kriteria = Kriteria::all();
        $bobot = Bobot::all();
        $nilai = NilaiPegawai::all();
        $pegawai = Pegawai::all();

        if($bobot->count() < 1){
            return view('admin.dashboard')->with('dimohon untuk mengenerate bobot terlebih dahulu');
        }

        $bobot_arr = [];
        foreach($bobot as $bbt){
            $bobot_arr[$bbt->id]=$bbt->nilai;
        }

        //mencari min and max dari nilai pegawai


        $nilai_arr = [];
        foreach($nilai as $i =>$ni){
            $nilai_arr[$ni->id_kriteria][$ni->id_pegawai] = $ni->nilai;
        }

        $nilai_arr_max = [];
        $nilai_arr_min = [];
        foreach($nilai_arr as $i=>$ni){
            $nilai_arr_max[$i]=max($ni);
            $nilai_arr_min[$i]=min($ni);
        }


        //x - min x / min x - max x
        $nilai_arr_2 = [];
        foreach($nilai_arr as $i=>$ni){
            foreach($ni as $j => $nii){
                $nilai_arr_2[$i][$j] = pow($nii - ($nilai_arr_min[$i]/$nilai_arr_max[$i])-$nilai_arr_min[$i],2)/1.71;
            }
        }

        $nilai_arr_3 = [];
        foreach($nilai_arr_2 as $i=>$ni){
            foreach($ni as $j => $nii){
                $nilai_arr_3[$j][$i] = $nii*$bobot_arr[$i];
            }
        }


        $nilai_arr_3_sum =[];
        foreach($nilai_arr_3 as $i=> $ni){
            $nilai_arr_3_sum[$i] = array_sum($ni);
        }
        arsort($nilai_arr_3_sum);
        // dd($nilai_arr_3_sum);



        // dd($nilai_arr_min);


        return view('admin.dashboard',['peringkat'=>$nilai_arr_3_sum,'pegawai'=>$pegawai]);
    }
}
