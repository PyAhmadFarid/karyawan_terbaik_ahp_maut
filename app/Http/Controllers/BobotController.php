<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\Perbandingan;

class BobotController extends Controller
{
    function index()
    {
        $kriteria = Kriteria::all();
        $n = $kriteria->count();
        if ($n < 2) {
            return view('admin.bobot')->with('message', 'no kriteria found');
        }

        //jika tidak ada nilai dalam tabel perbandingan
        if (Perbandingan::all()->count() != pow($n, 2)) {
            Perbandingan::truncate();

            foreach ($kriteria as $kr1) {
                foreach ($kriteria as $kr2) {
                    Perbandingan::create([
                        'id_kriteria_1' => $kr1->id,
                        'id_kriteria_2' => $kr2->id,
                        'nilai' => 1
                    ]);
                }
            }
        }


        $perbandingan = Perbandingan::all();
        $bobot = Bobot::all();


        if ($bobot->count() > 0) {



            

            $matrix_a = array_fill(1, $n, array_fill(1, $n, 0));

            foreach ($perbandingan as $per) {
                $matrix_a[$per->id_kriteria_1][$per->id_kriteria_2] = $per->nilai * $bobot[$per->id_kriteria_1 - 1]->nilai;
            }

            $jumblah_matrix_a = array_fill(1, $n, 0);
            $jumblah_matrix_b = array_fill(1, $n, 0);
            // dd(array_sum($matrix_a[1]));
            foreach ($matrix_a as $i => $mx) {
                $jumblah_matrix_a[$i] = array_sum($mx);
                $jumblah_matrix_b[$i] = array_sum($mx) + $bobot[$i - 1]->nilai;
            }
            $tab_rand_index = [1 => 0.0, 2 => 0.0, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];


            $sigmaMax = array_sum($jumblah_matrix_b) / $n;
            $ci = ($sigmaMax - $n) / ($n - 1);
            $cr = $ci / $tab_rand_index[$n];
            // dd($cr);
            // dd($jumblah_matrix_b);


            // dd($kriteria[0]->perbandigan);
            // dd(Perbandingan::all());
            return view('admin.bobot', ['kriteria' => $kriteria, 'nilai' => $perbandingan, 'bobot' => $bobot, 'sigmaMax' => $sigmaMax, 'ci' => $ci, 'cr' => $cr, 'konsisten' => ($cr < 0.01)]);
        }

        return view('admin.bobot', ['kriteria' => $kriteria, 'nilai' => $perbandingan]);
    }

    function generate(Request $request)
    {
        $kriteria = Kriteria::all();
        $n = $kriteria->count();
        // dd($request->all());
        $total = array_fill(0, $n, 0);




        for ($i = 1; $i < $n + 1; $i++) {
            $ttl = 0;
            for ($j = 1; $j < $n + 1; $j++) {
                $p = Perbandingan::where('id_kriteria_1', '=', $i)->where('id_kriteria_2', '=', $j)->get()->first();
                $p->nilai = $request[$i . ":" . $j];
                $ttl += $request[$j . ":" . $i];
                $p->save();
            }
            $total[$i - 1] = $ttl;
        }
        $tabel_bobot = array_fill(0, $n, array_fill(0, $n, 0));
        for ($i = 1; $i < $n + 1; $i++) {

            for ($j = 1; $j < $n + 1; $j++) {
                // $p = Perbandingan::where('id_kriteria_1','=',$i)->where('id_kriteria_2','=',$j)->get()->first();

                $tabel_bobot[$j - 1][$i - 1] = $request[$i . ":" . $j] / $total[$j - 1];
            }
        }

        $tabel_bobot_total = array_fill(0, $n, 0);
        $pv = array_fill(0, $n, 0);
        for ($i = 0; $i < $n; $i++) {
            $tt = 0;
            for ($j = 0; $j < $n; $j++) {
                $tt += $tabel_bobot[$j][$i];
            }
            $tabel_bobot_total[$i] = $tt;
            $pv[$i] = $tt / $n;
        }
        // dd($pv);

        foreach ($kriteria as $i => $kr) {
            // dd($kr->id);
            $bobot = Bobot::where('id_kriteria', '=', $kr->id)->first();
            // dd($bobot);
            if ($bobot == null) {
                Bobot::create([
                    'id_kriteria' => $kr->id,
                    'nilai' => $pv[$i],
                ]);
            } else {
                $bobot->nilai = $pv[$i];
                $bobot->save();
            }
        }




        // dd($total);


        return redirect()->back();
    }
}
