<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Semua kolom boleh diisi (data selalu sudah divalidasi di controller)
    protected $guarded = [];

    protected $casts = ['birth_date' => 'date'];

}
