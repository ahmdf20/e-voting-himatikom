<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidates extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vision(): HasOne
    {
        return $this->hasOne(Vision::class);
    }

    public function subvote(): HasOne
    {
        return $this->hasOne(SubVote::class);
    }
}
