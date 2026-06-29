<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $table = 'submissions';

    protected $fillable = [
        'user_id',
        'problem_code',
        'language_id',
        'source_code',
        'stdin',
        'expected_output',
        'stdout',
        'stderr',
        'compile_output',
        'status',
        'judge_token',
        'execution_time',
        'memory_used',
    ];

    protected $casts = [
        'execution_time' => 'decimal:3',
        'memory_used' => 'integer',
    ];

    public function isAccepted(): bool
    {
        return $this->status === 'Accepted';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
