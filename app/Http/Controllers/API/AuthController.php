<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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


    public function prijava(Request $request)
    {

        if (!Auth::attempt($request->only('username', 'password'))) {
            return;
        } else {

            $user = User::where('username', $request['username'])->firstOrFail();

            $token = $user->createToken("LGN_" . $user->ime_prezime . "_TOKEN_" . $user->username)->plainTextToken;

            return response()->json([
                'value' => 'true',
                'id' => $user->id,  
                'username' => $request->username,
                'token' => $token,
                'vrsta_korisnika' => $user->vrsta_korisnika
            ]);
        }
    }


    public function odjava()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'value' => 'true'
        ]);
    }
}
