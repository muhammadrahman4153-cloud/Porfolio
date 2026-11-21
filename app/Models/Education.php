<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // Semua kolom boleh diisi (data selalu sudah divalidasi di controller)
    protected $guarded = [];
    protected $table = 'educations';

}
