<?php
namespace App\Http\Controllers\Admin;

use App\Models\Experience;

class ExperienceController extends CrudController
{
    protected string $model = Experience::class;
    protected string $route = 'admin.experiences';
    protected string $title = 'Pengalaman Organisasi';

    protected function query() { return Experience::orderByDesc('start_year'); }

    protected function rules(): array
    {
        return [
            'organization' => 'required|string|max:150',
            'position'     => 'required|string|max:150',
            'start_year'   => 'required|integer|min:1980|max:2100',
            'end_year'     => 'nullable|integer|min:1980|max:2100|gte:start_year',
            'description'  => 'nullable|string|max:1000',
        ];
    }

    protected function fields(): array
    {
        return [
            ['name' => 'organization', 'label' => 'Nama Organisasi', 'type' => 'text', 'required' => true],
            ['name' => 'position', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
            ['name' => 'start_year', 'label' => 'Tahun Mulai', 'type' => 'number', 'required' => true],
            ['name' => 'end_year', 'label' => 'Tahun Selesai (kosongkan jika masih aktif)', 'type' => 'number'],
            ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea'],
        ];
    }

    protected function columns(): array
    {
        return [
            ['key' => 'organization', 'label' => 'Organisasi'],
            ['key' => 'position', 'label' => 'Jabatan'],
            ['key' => 'start_year', 'label' => 'Mulai'],
            ['key' => 'end_year', 'label' => 'Selesai'],
        ];
    }
}
