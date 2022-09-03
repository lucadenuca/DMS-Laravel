<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dokument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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


        $dok->save();

        return response()->json([
            'value' => 'true'
        ]);
    }



    public function getDocuments($id)
    {
        $documents = DB::table('dokuments')->where('korisnik_id', $id)->get();

        return response()->json([
            'documents' => $documents
        ]);
    }


    public function deleteDocument($id)
    {
        $putanja = DB::table('dokuments')->where('id', $id)->first();
        File::delete($putanja);

        DB::table('dokuments')->where('id', $id)->delete();

        return response()->json([
            'value' => 'true'
        ]);
    }


    public function editDocument($id)
    {
        $document = DB::table('dokuments')->where('id', $id)->first();

        return response()->json([
            'document' => $document
        ]);
    }


    public function updateDocument($id, Request $request)
    {
        $name = $request->fajl->getClientOriginalName();
        $putanja = 'docs/' . $name;

        if (File::exists($putanja)) {
            File::delete($putanja);
        }

        $fajlBaza = DB::table('dokuments')->where('id', $id)->first();
        File::delete($fajlBaza->putanja);

        $request->fajl->move(public_path('docs/'), $name);


        DB::table('dokuments')
            ->where('id', $id)
            ->update([
                'naziv' => $request->naziv,
                'opis' => $request->opis,
                'kategorija' => $request->kategorija,
                'putanja' => $putanja
            ]);
    }
}
