<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dokument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokController extends Controller
{
    public function upload(Request $request)
    {

        $dok = new Dokument();
        $dok->naziv = $request->input('naziv');
        $dok->opis = $request->input('opis');
        $dok->kategorija = $request->input('kategorija');
        $dok->korisnik_id = $request->input('korisnik');

        if ($request->hasFile('fajl')) {
            $fajl = $request->file('fajl');
            $naziv_fajla = $fajl->getClientOriginalName();
            $fajl->move(public_path('docs'), $naziv_fajla);
            $putanja = "docs/" . $naziv_fajla;
            $dok->putanja = $putanja;
        }

        LOG::debug($dok);

        $dok->save();

        return response()->json([
            'value' => 'true'
        ]);
    }
}
