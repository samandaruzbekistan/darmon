<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        // Add other fillable properties here
        'type',
        'block_id',
        'space_count',
    ];

    public function block(){
        return $this->belongsTo(Block::class);
    }
}
