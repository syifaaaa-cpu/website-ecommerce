<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // INI WAJIB ADA agar Laravel mengizinkan kolom 'message' diisi
    protected $fillable = ['message'];
}
