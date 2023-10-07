<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\Vote;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'E-Voting HIMATIKOM',
            'votes' => Vote::all()
        ]);
    }

    public function voteCandidate(Vote $votes): View
    {
        return view('home.vote-candidate', [
            'title' => 'E-Voting HIMATIKOM',
            'vote' => $votes
        ]);
    }

    public function tokenCheck(Request $request)
    {
        if (!$request->token) {
            return response()->json(['message' => 'Inputan token tidak boleh kosong!', 'icon' => 'error']);
        }

        $token = AccessToken::where('token', '=', $request->token)->first();
        if (!$token) {
            $data = [
                'message' => 'Token tidak ditemukan',
                'icon' => 'error'
            ];
            return response()->json($data);
        }
        if ($token->is_used == 1) {
            $data = [
                'message' => 'Anda tidak dapat menggunakan token ini! Token telah digunakan!',
                'icon' => 'error'
            ];
            return response()->json($data);
        }
        DB::table('access_tokens')->where('token', '=', $request->token)->update(['is_used' => 1]);
        $data = [
            'message' => 'Token dapat digunakan, silahkan untuk memilih!',
            'icon' => 'success',
            'token' => $request->token,
        ];
        return response()->json($data);
    }
}
