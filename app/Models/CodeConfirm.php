<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeConfirm extends Model
{
    use HasFactory;

    protected $table = 'code_confirms';

    protected $fillable = [
        'phone',
        'code',
        'is_confirmed',
    ];
}
