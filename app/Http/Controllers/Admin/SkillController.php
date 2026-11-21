<?php
namespace App\Http\Controllers\Admin;

use App\Models\Skill;

class SkillController extends CrudController
{
    protected string $model = Skill::class;
    protected string $route = 'admin.skills';
    protected string $title = 'Keahlian';

    protected function query() { return Skill::orderBy('category')->orderByDesc('percentage'); }

    protected function rules(): array
    {
        return [
            'name'       => 'required|string|max:100',
            'category'   => 'required|in:Programming,Design,Database,Lainnya',
            'percentage' => 'required|integer|min:0|max:100',
        ];
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Nama Keahlian', 'type' => 'text', 'required' => true],
            ['name' => 'category', 'label' => 'Kategori', 'type' => 'select', 'required' => true,
                'options' => ['Programming' => 'Programming', 'Design' => 'Design', 'Database' => 'Database', 'Lainnya' => 'Lainnya']],
            ['name' => 'percentage', 'label' => 'Persentase (0-100)', 'type' => 'number', 'required' => true],
        ];
    }

    protected function columns(): array
    {
        return [
            ['key' => 'name', 'label' => 'Keahlian'],
            ['key' => 'category', 'label' => 'Kategori', 'type' => 'badge'],
            ['key' => 'percentage', 'label' => 'Persentase', 'type' => 'percent'],
        ];
    }
}
