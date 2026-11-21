<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $item = Profile::firstOrCreate([], ['name' => 'Nama Anda', 'title' => 'Web Developer']);

        return view('admin.profile', ['item' => $item, 'fields' => $this->fields()]);
    }

    public function update(Request $request)
    {
        $item = Profile::firstOrFail();

        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'title'      => 'nullable|string|max:100',
            'bio'        => 'nullable|string|max:2000',
            'email'      => 'nullable|email|max:150',
            'phone'      => 'nullable|string|max:30',
            'address'    => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'github'     => 'nullable|url|max:255',
            'linkedin'   => 'nullable|url|max:255',
            'instagram'  => 'nullable|url|max:255',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cv'         => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Upload foto & CV (ganti file lama bila ada file baru)
        foreach (['photo' => 'profile', 'cv' => 'cv'] as $field => $folder) {
            if ($request->hasFile($field)) {
                if ($item->$field) {
                    Storage::disk('public')->delete($item->$field);
                }
                $data[$field] = $request->file($field)->store($folder, 'public');
            } else {
                unset($data[$field]);
            }
        }

        $item->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    private function fields(): array
    {
        return [
            ['name' => 'name', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
            ['name' => 'title', 'label' => 'Profesi / Jabatan', 'type' => 'text'],
            ['name' => 'bio', 'label' => 'Deskripsi Singkat', 'type' => 'textarea'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'text'],
            ['name' => 'phone', 'label' => 'No. Telepon', 'type' => 'text'],
            ['name' => 'address', 'label' => 'Alamat', 'type' => 'text'],
            ['name' => 'birth_date', 'label' => 'Tanggal Lahir', 'type' => 'date'],
            ['name' => 'github', 'label' => 'Link GitHub', 'type' => 'text'],
            ['name' => 'linkedin', 'label' => 'Link LinkedIn', 'type' => 'text'],
            ['name' => 'instagram', 'label' => 'Link Instagram', 'type' => 'text'],
            ['name' => 'photo', 'label' => 'Foto Profil (maks. 2 MB)', 'type' => 'file'],
            ['name' => 'cv', 'label' => 'File CV (PDF, maks. 5 MB)', 'type' => 'file', 'accept' => '.pdf'],
        ];
    }
}
