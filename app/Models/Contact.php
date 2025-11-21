<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // gunakan tabel plural sesuai migration
    protected $table = 'contact';

    // field yang boleh diisi mass-assignment
    protected $fillable = ['name', 'email', 'message'];
}

