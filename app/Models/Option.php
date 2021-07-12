<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function Poll(){
        return $this->belongsTo(Poll::class, 'poll_id');
    }

    protected $fillable = [
        'option_1',
        'option_2',
        'option_3',
        'option_4'
    ];
}
