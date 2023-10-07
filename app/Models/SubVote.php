<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubVote extends Model
{
    use HasFactory;
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidates::class);
    }

    public function vote(): BelongsTo
    {
        return $this->belongsTo(Vote::class);
    }
}
