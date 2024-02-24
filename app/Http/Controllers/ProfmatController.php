<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use App\Models\User;
use Illuminate\Http\Request;

class ProfmatController extends Controller
{

    function array_rank($array) {
        $sortedArray = $array;
        arsort($sortedArray);  // Sort the array in descending order while preserving keys

        // dd($sortedArray);
        $rankedArray = [];
        $rank = 1;

        foreach ($sortedArray as $index => $value) {
            $rankedArray[$index] = $rank;
            $rank++;
        }

    return $rankedArray;
    }

    function reformatArray($array) {
        $formattedArray = [];

        foreach ($array as $index => $value) {
            $formattedArray[] = [$index => $value];
        }

        return $formattedArray;
    }

    function make_rank($array){
        arsort($array);
        // Custom sorting function for elements with the same values
        uksort($array, function($a, $b) use ($array) {
            // dd($array);
            if ($array[$a] == $array[$b]) {
                if ($a < $b) {
                    return $a <=> $b; // Sort in ascending order based on keys
                }
            }
            return 0; // Maintain the order for elements with different values
        });

        $rank = 1;
        $rankedArray = [];

        foreach ($array as $index => $value) {
            $rankedArray[$index] = $rank;
            $rank++;
        }

        return $array;
    }

    function transform_rank($inputArray) {
        // Extract the inner array
        $array = [];
        // dd($inputArray);
        foreach ($inputArray as $i => $a) {
            // $array = reset($inputArray);
            // dd($a);
            $array = array_replace($array, $a);
        }
        // $ranked = ProfmatController::array_rank($array);
        // return $ranked;
        // dd($array,$ranked);

    }

    function reverse_karray( $in ) {
        $k = array_keys($in);
        $kr = array_reverse($k);

        $v = array_values($in);
        $rv = array_reverse($v);

        $b = array_combine($kr, $rv);

        return $b;
    }

        function reverse_rank( $in ) {
            $k = array_keys($in);
            $v = array_values($in);

            $rv = array_reverse($v);

            $b = array_combine($k, $rv);

            return $b;
        }

        public function gap($nilai, $target)
        {
            $selisih = $nilai - $target;
            return $selisih;
        }

        function bobotgap($nilai, $target){
            $dfselisih = [0, 1, -1, 2, -2, 3, -3, 4, -4];
            $dfbobot = [5, 4.5, 4, 3.5, 3, 2.5, 2, 1.5, 1];

            $selisih = $nilai - $target;

            foreach($dfselisih as $i => $sel){
                if ($selisih == $sel){
                    return $dfbobot[$i];
                } else if ($selisih < -4){
                    return 1;
                }
            }

        }

        public function profmat(){
            #get semua data
            $users = User::all();
            $alt = Alternatif::all();
            $krit = Kriteria::all();
            $sub = Subkriteria::all();
            $peniliaian = Penilaian::all();

            #perhitungan corefactor dan secondaryfactor

            foreach($users->where('role', '!=', 'admin') as $u => $user){
                foreach($alt as $a => $al){
                    $corefactoraddition[$user->id][$al->id] = 0;
                    $secondaryfactoraddition[$user->id][$al->id] = 0;
                    // dd($krit->where('jenis_kriteria', 'cf'));
                    foreach($krit->where('jenis_kriteria', 'cf') as $k => $kr){
                        try {
                            $nilai[$user->id][$al->id][$kr->id] = Penilaian::where('id_kriteria', $kr->id)->where('id_user', $user->id)->where('id_alternatif', $al->id)->first()->nilai;
                        } catch (\Throwable $th) {
                            $nilai[$user->id][$al->id][$kr->id] = NULL;
                        }
                        $gap[$user->id][$al->id][$kr->id] = ProfmatController::gap($nilai[$user->id][$al->id][$kr->id], 7);
                        $bobotgap[$user->id][$al->id][$kr->id] = ProfmatController::bobotgap($nilai[$user->id][$al->id][$kr->id], 7);
                        $bobotgapcf[$user->id][$al->id][$kr->id] = ProfmatController::bobotgap($nilai[$user->id][$al->id][$kr->id], 7);
                        $corefactoraddition[$user->id][$al->id] = $corefactoraddition[$user->id][$al->id] + $bobotgapcf[$user->id][$al->id][$kr->id];
                    }
                    $corefactor[$user->id][$al->id] = $corefactoraddition[$user->id][$al->id] / $krit->where('jenis_kriteria', 'cf')->count();
                    foreach($krit->where('jenis_kriteria', 'sf') as $k => $kr){
                        try {
                            $nilai[$user->id][$al->id][$kr->id] = Penilaian::where('id_kriteria', $kr->id)->where('id_user', $user->id)->where('id_alternatif', $al->id)->first()->nilai;
                        } catch (\Throwable $th) {
                            $nilai[$user->id][$al->id][$kr->id] = NULL;
                        }
                        $gap[$user->id][$al->id][$kr->id] = ProfmatController::gap($nilai[$user->id][$al->id][$kr->id], 7);
                        $bobotgap[$user->id][$al->id][$kr->id] = ProfmatController::bobotgap($nilai[$user->id][$al->id][$kr->id], 7);
                        $bobotgapsf[$user->id][$al->id][$kr->id] = ProfmatController::bobotgap($nilai[$user->id][$al->id][$kr->id], 7);
                        $secondaryfactoraddition[$user->id][$al->id] = $secondaryfactoraddition[$user->id][$al->id] + $bobotgapsf[$user->id][$al->id][$kr->id];
                    }
                    $secondaryfactor[$user->id][$al->id] = $secondaryfactoraddition[$user->id][$al->id] / $krit->where('jenis_kriteria', 'sf')->count();

                    $nilaitotal[$user->id][$al->id] = number_format(($corefactor[$user->id][$al->id]*0.6)+($secondaryfactor[$user->id][$al->id]*0.4), 1, '.', '');

                    $nilaiborda[$al->id] = 0;
                    $jumlah[$a] = $a+1;
                }
                // dd($nilaitotal[$user->id], ProfmatController::reverse_karray($nilaitotal[$user->id]) );
                $totalrank[$user->id] = ProfmatController::array_rank($nilaitotal[$user->id]);
                // $reformatnilaitotal = ProfmatController::reformatArray($nilaitotal[$user->id]);
                // $ranktot[$user->id] = ProfmatController::make_rank($nilaitotal[$user->id]);
                // $finrank[$user->id] = ProfmatController::transform_rank($ranktot[$user->id]);
                // dd($ranktot);
            }
            // dd($nilaitotal,$totalrank);
            // dd($ranktot);
            // dd($nilaitotal[13]);
            // arsort($nilaitotal[13]);
            // dd($nilaitotal[13]);

            //borda
            $nilaikhususborda = array();
            $jumlahreverse = ProfmatController::reverse_rank($jumlah);

            // dd($jumlah, $jumlahreverse);

            foreach($jumlah as $i => $a) {
                $nilaikhususborda[] = array($a, $jumlahreverse[$i]);
            }

            // dd($nilaikhususborda);

            foreach($alt as $a => $al){
                foreach ($users->where('role', '!=', 'admin') as $u => $user) {
                    foreach($nilaikhususborda as $i => $b){
                        if ($totalrank[$user->id][$al->id] == $b[0]) {
                            $nilaiborda[$al->id] += $b[1];
                        }
                    }
                }
            }

            $bordarank = ProfmatController::array_rank($nilaiborda);


            // dd($bordarank, $nilaiborda);

            // Setelah Anda menghitung nilai borda, tambahkan nilai borda ke dalam objek Alternatif
            foreach($alt as $a => $al){
                $al->nilaiborda = $nilaiborda[$al->id];
            }

            // Urutkan objek Alternatif berdasarkan nilai borda
            $sortedAlt = $alt->sortByDesc('nilaiborda');



            return view('auth.profmat', [
                'users' => $users,
                'alter' => $sortedAlt,
                'normalalter' => $alt,
                'krit' => $krit,
                'sub' => $sub,
                'nilai' => $peniliaian,
                'gap' => $gap,
                'bobotgap' => $bobotgap,
                'corefactor' => $corefactor,
                'secondaryfactor' => $secondaryfactor,
                'total' => $nilaitotal,
                'totalrank' => $totalrank,
                'bordarank' => $bordarank,
                'nilaiborda' => $nilaiborda
            ]);

        }

        public function indexHasil()
        {
            return view('auth.hasil', [
                'users' => ProfmatController::profmat()->users,
                'alter' => ProfmatController::profmat()->alter,
                'krit' => ProfmatController::profmat()->krit,
                'sub' => ProfmatController::profmat()->sub,
                'nilai' => ProfmatController::profmat()->nilai,
                'gap' => ProfmatController::profmat()->gap,
                'bobotgap' => ProfmatController::profmat()->bobotgap,
                'corefactor' => ProfmatController::profmat()->corefactor,
                'secondaryfactor' => ProfmatController::profmat()->secondaryfactor,
                'total' => ProfmatController::profmat()->total,
                'totalrank' => ProfmatController::profmat()->totalrank,
                'bordarank' => ProfmatController::profmat()->bordarank,
                'nilaiborda' => ProfmatController::profmat()->nilaiborda
            ]);
        }

        public function indexHasilGuest()
        {
            return view('hasil-guest', [
                'users' => ProfmatController::profmat()->users,
                'alter' => ProfmatController::profmat()->alter,
                'krit' => ProfmatController::profmat()->krit,
                'sub' => ProfmatController::profmat()->sub,
                'nilai' => ProfmatController::profmat()->nilai,
                'gap' => ProfmatController::profmat()->gap,
                'bobotgap' => ProfmatController::profmat()->bobotgap,
                'corefactor' => ProfmatController::profmat()->corefactor,
                'secondaryfactor' => ProfmatController::profmat()->secondaryfactor,
                'total' => ProfmatController::profmat()->total,
                'totalrank' => ProfmatController::profmat()->totalrank,
                'bordarank' => ProfmatController::profmat()->bordarank,
                'nilaiborda' => ProfmatController::profmat()->nilaiborda
            ]);
        }


}
