<?php

namespace App\Http\Controllers;

use App\Models\SubVote;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubVoteController extends Controller
{
    public function store(Request $request, Vote $votes)
    {
        $data = [
            'vote_id' => $votes->id,
            'candidate_id' => $request->subvote,
            'created_at' => now('Asia/Jakarta')
        ];
        DB::table('sub_votes')->insert($data);
        return to_route('votes.show', ['votes' => $votes->id]);
    }

    public function vote(Request $request, Vote $votes)
    {
        $current = DB::table('sub_votes')->where([
            ['vote_id', '=', $votes->id],
            ['candidate_id', '=', $request->candidate_id]
        ])->get();
        // dd($current);
        foreach ($current as $c) {
            DB::table('sub_votes')->where([
                ['vote_id', '=', $votes->id],
                ['candidate_id', '=', $request->candidate_id],
            ])
                ->update([
                    'score' => $c->score + 1
                ]);
        }
        return response()->json(['message' => 'Terimakasih telah memilih! #YUJANGANGOLPUT']);
    }
}
