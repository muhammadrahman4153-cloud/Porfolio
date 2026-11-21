<?php
namespace App\Http\Controllers\Admin;

use App\Models\Certificate;

class CertificateController extends CrudController
{
    protected string $model = Certificate::class;
    protected string $route = 'admin.certificates';
    protected string $title = 'Sertifikat';
    protected string $imageField = 'image';
    protected string $imageFolder = 'certificates';

    protected function query() { return Certificate::orderByDesc('issued_date'); }

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:150',
            'issuer'      => 'nullable|string|max:150',
            'issued_date' => 'required|date',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    protected function fields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Nama Sertifikat', 'type' => 'text', 'required' => true],
            ['name' => 'issuer', 'label' => 'Penerbit', 'type' => 'text'],
            ['name' => 'issued_date', 'label' => 'Tanggal Terbit', 'type' => 'date', 'required' => true],
            ['name' => 'image', 'label' => 'Gambar Sertifikat (maks. 2 MB)', 'type' => 'file'],
        ];
    }

    protected function columns(): array
    {
        return [
            ['key' => 'image', 'label' => 'Gambar', 'type' => 'image'],
            ['key' => 'name', 'label' => 'Nama Sertifikat'],
            ['key' => 'issuer', 'label' => 'Penerbit'],
            ['key' => 'issued_date', 'label' => 'Tanggal', 'type' => 'date'],
        ];
    }
}
