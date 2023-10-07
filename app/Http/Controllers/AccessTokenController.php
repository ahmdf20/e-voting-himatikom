<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class AccessTokenController extends Controller
{
    public function index()
    {
        return view('token.index', [
            'tokens' => AccessToken::paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $start = 1;
        $limit = $request->limit;
        while ($start <= $limit) {
            $token = strtoupper(Random::generate(8, 'a-z'));
            AccessToken::create([
                'token' => $token,
                'is_used' => 0,
                'created_at' => now('Asia/Jakarta'),
            ]);
            $start++;
        }
        return response()->json(['message' => "Berhasil generate token sebanyak $limit"]);
    }
}
