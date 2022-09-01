<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registracija(Request $request)
    {
        $user = User::create([
            'vrsta_korisnika' => 'korisnik',
            'ime_prezime' => $request->ime_prezime,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        $user->createToken("REG_" . $user->ime_prezime . "_TOKEN_" . $user->username)->plainTextToken;

        return response()->json([
            'value' => 'true'
        ]);
    }
}
