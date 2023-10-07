<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\Vote;
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
        $token = AccessToken::where('token', '=', $request->token)->get();
        if ($token) {
            DB::table('access_tokens')->where('token', '=', $request->token)->update(['is_used' => 1]);
            return response()->json(['message' => 'Token dapat digunakan, silahkan untuk memilih!']);
        }
        return redirect()->back();
    }
}
