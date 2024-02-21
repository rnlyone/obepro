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

    function array_rank( $in ) {
        $x = $in; arsort($x);
        $rank       = 0;
        $hiddenrank = 0;
        $hold = null;
        foreach ( $x as $key=>$val ) {
            $hiddenrank += 1;
            $rank = $hiddenrank;
            if ( is_null($hold) || $val < $hold ) {
                $hold = $val;
            }
            $in[$key] = $rank;
        }
        return $in;
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

                    $nilaitotal[$user->id][$al->id] = ($corefactor[$user->id][$al->id]*0.6)+($secondaryfactor[$user->id][$al->id]*0.4);

                    $nilaiborda[$al->id] = 0;
                    $jumlah[$a] = $a+1;
                }
                $totalrank[$user->id] = ProfmatController::array_rank($nilaitotal[$user->id]);
                // dd($totalrank);
            }

            //borda
            $nilaikhususborda = array();
            $jumlahreverse = ProfmatController::reverse_rank($jumlah);

            foreach($jumlah as $i => $a) {
                $nilaikhususborda[] = array($a, $jumlahreverse[$i]);
            }

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


            return view('auth.profmat', [
                'users' => $users,
                'alter' => $alt,
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


}
