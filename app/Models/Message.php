<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Semua kolom boleh diisi (data selalu sudah divalidasi di controller)
    protected $guarded = [];

    protected $casts = ['is_read' => 'boolean'];

}
