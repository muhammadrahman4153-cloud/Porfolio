<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends CrudController
{
    protected string $model = Category::class;
    protected string $route = 'admin.categories';
    protected string $title = 'Kategori Proyek';

    protected function rules(): array
    {
        // Saat edit, abaikan nama milik data itu sendiri
        $id = request()->route('category');
        return ['name' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($id)]];
    }

    protected function fields(): array
    {
        return [['name' => 'name', 'label' => 'Nama Kategori', 'type' => 'text', 'required' => true]];
    }

    protected function columns(): array
    {
        return [['key' => 'name', 'label' => 'Nama Kategori'], ['key' => 'projects_count', 'label' => 'Jumlah Proyek']];
    }

    protected function query() { return Category::withCount('projects')->orderBy('name'); }
}
