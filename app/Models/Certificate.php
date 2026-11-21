<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    // Semua kolom boleh diisi (data selalu sudah divalidasi di controller)
    protected $guarded = [];

    protected $casts = ['issued_date' => 'date'];

}
