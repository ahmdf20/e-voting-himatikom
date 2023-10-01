<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Vision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidates::all();

        return view('candidates.index', [
            'candidates' => $candidates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.candidates-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kahim' => 'required',
            'nim_kahim' => 'required|numeric',
            'foto_kahim' => 'image|file|required|max:8192',
            'nama_wakahim' => 'required',
            'nim_wakahim' => 'required|numeric',
            'foto_wakahim' => 'image|file|required|max:8192',
            'visi' => 'required',
            'misi' => 'required'
        ]);

        $foto_kahim = $request->file('foto_kahim')->store('image');
        $foto_wakahim = $request->file('foto_wakahim')->store('image');

        $new_candidates = [
            'nama_kahim' => $request->nama_kahim,
            'nim_kahim' => $request->nim_kahim,
            'kelas_kahim' => $request->kelas_kahim,
            'foto_kahim' => $foto_kahim,
            'nama_wakahim' => $request->nama_wakahim,
            'nim_wakahim' => $request->nim_wakahim,
            'kelas_wakahim' => $request->kelas_wakahim,
            'foto_wakahim' => $foto_wakahim,
            'created_at' => now('Asia/Jakarta')
        ];

        $candidate_id = Candidates::create($new_candidates)->id;

        $relation_candidates_to_vision = [
            'candidates_id' => $candidate_id,
            'misi' => $request->misi,
            'visi' => htmlspecialchars($request->visi)
        ];
        Vision::create($relation_candidates_to_vision);

        $message = [
            'title' => 'Berhasil',
            'body' => 'Berhasil menginputkan kandidat baru!',
            'icon' => 'success',
        ];

        return to_route('voting')->with($message);
    }

    public function delete(Candidates $candidates)
    {
        $candidates->delete();
        $data = [
            'title' => 'Hapus data!',
            'body' => 'Berhasil menghapus data!',
            'icon' => 'success'
        ];
        return response()->json($data);
    }
}
