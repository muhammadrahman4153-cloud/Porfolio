<?php
namespace App\Http\Controllers\Admin;

use App\Models\{Category, Project};

class ProjectController extends CrudController
{
    protected string $model = Project::class;
    protected string $route = 'admin.projects';
    protected string $title = 'Proyek';
    protected string $imageField = 'image';
    protected string $imageFolder = 'projects';

    protected function query() { return Project::with('category')->latest(); }

    protected function rules(): array
    {
        return [
            'title'        => 'required|string|max:150',
            'category_id'  => 'nullable|exists:categories,id',
            'description'  => 'required|string|max:2000',
            'technologies' => 'nullable|string|max:255',
            'project_url'  => 'nullable|url|max:255',
            'github_url'   => 'nullable|url|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title', 'label' => 'Nama Proyek', 'type' => 'text', 'required' => true],
            ['name' => 'category_id', 'label' => 'Kategori', 'type' => 'select',
                'options' => Category::orderBy('name')->pluck('name', 'id')->toArray(), 'empty' => '- Tanpa kategori -'],
            ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea', 'required' => true],
            ['name' => 'technologies', 'label' => 'Teknologi (pisahkan dengan koma)', 'type' => 'text'],
            ['name' => 'project_url', 'label' => 'Link Proyek (https://...)', 'type' => 'text'],
            ['name' => 'github_url', 'label' => 'Link GitHub (https://...)', 'type' => 'text'],
            ['name' => 'image', 'label' => 'Gambar / Thumbnail (maks. 2 MB)', 'type' => 'file'],
        ];
    }

    protected function columns(): array
    {
        return [
            ['key' => 'image', 'label' => 'Gambar', 'type' => 'image'],
            ['key' => 'title', 'label' => 'Nama Proyek'],
            ['key' => 'category.name', 'label' => 'Kategori', 'type' => 'badge'],
            ['key' => 'technologies', 'label' => 'Teknologi'],
        ];
    }
}
