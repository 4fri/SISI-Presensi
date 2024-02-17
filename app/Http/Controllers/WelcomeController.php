<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }

    public function cetakPolaBintang(Request $req)
    {
        $jumlah_bintang = $req->jumlah_bintang;
        $pola_bintang = $this->generatePolaBintang($jumlah_bintang);

        return response()->json(['pola_bintang' => $pola_bintang]);
    }

    private function generatePolaBintang($jumlah_bintang)
    {
        $pola = [];
        for ($i = 1; $i <= $jumlah_bintang; $i++) {
            $baris = str_repeat('*', $i);
            $pola[] = $baris;
        }

        return $pola;
    }

    public function cetakPolaAngka(Request $req)
    {
        $jumlah_angka = $req->jumlah_angka;
        $pola_bintang = $this->generatePolaAngka($jumlah_angka);

        return response()->json(['pola_bintang' => $pola_bintang]);
    }

    private function generatePolaAngka($jumlah_angka)
    {
        $pola = [];
        for ($i = 1; $i <= $jumlah_angka; $i++) {
            $baris = implode('', range(1, $i));
            $pola[] = $baris;
        }

        return $pola;
    }
}
