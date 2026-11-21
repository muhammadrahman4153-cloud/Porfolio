<?php
namespace App\Http\Controllers\Admin;

use App\Models\Education;

class EducationController extends CrudController
{
    protected string $model = Education::class;
    protected string $route = 'admin.educations';
    protected string $title = 'Pendidikan';

    protected function query() { return Education::orderByDesc('start_year'); }

    protected function rules(): array
    {
        return [
            'school'      => 'required|string|max:150',
            'level'       => 'required|string|max:50',
            'major'       => 'nullable|string|max:150',
            'start_year'  => 'required|integer|min:1980|max:2100',
            'end_year'    => 'nullable|integer|min:1980|max:2100|gte:start_year',
            'description' => 'nullable|string|max:1000',
        ];
    }

    protected function fields(): array
    {
        return [
            ['name' => 'school', 'label' => 'Nama Sekolah / Kampus', 'type' => 'text', 'required' => true],
            ['name' => 'level', 'label' => 'Jenjang', 'type' => 'select', 'required' => true,
                'options' => ['SMA/SMK' => 'SMA/SMK', 'D3' => 'D3', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3']],
            ['name' => 'major', 'label' => 'Jurusan', 'type' => 'text'],
            ['name' => 'start_year', 'label' => 'Tahun Masuk', 'type' => 'number', 'required' => true],
            ['name' => 'end_year', 'label' => 'Tahun Lulus (kosongkan jika masih berjalan)', 'type' => 'number'],
            ['name' => 'description', 'label' => 'Keterangan', 'type' => 'textarea'],
        ];
    }

    protected function columns(): array
    {
        return [
            ['key' => 'school', 'label' => 'Sekolah / Kampus'],
            ['key' => 'level', 'label' => 'Jenjang'],
            ['key' => 'major', 'label' => 'Jurusan'],
            ['key' => 'start_year', 'label' => 'Masuk'],
            ['key' => 'end_year', 'label' => 'Lulus'],
        ];
    }
}
