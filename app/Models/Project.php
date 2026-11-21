<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Semua kolom boleh diisi (data selalu sudah divalidasi di controller)
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Mengubah 'Laravel, MySQL' menjadi array ['Laravel', 'MySQL']
    public function getTechListAttribute(): array
    {
        return array_filter(array_map('trim', explode(',', (string) $this->technologies)));
    }

}
