<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller dasar untuk semua CRUD di dashboard.
 * Setiap controller turunan hanya perlu menentukan: model, route, judul,
 * aturan validasi (rules), isian form (fields), dan kolom tabel (columns).
 */
abstract class CrudController extends Controller
{
    protected string $model;            // contoh: \App\Models\Skill::class
    protected string $route;            // contoh: 'admin.skills'
    protected string $title;            // contoh: 'Keahlian'
    protected string $imageField = '';  // nama kolom gambar (kosong = tidak ada upload)
    protected string $imageFolder = 'uploads';

    abstract protected function rules(): array;
    abstract protected function fields(): array;
    abstract protected function columns(): array;

    protected function query()
    {
        return $this->model::latest();
    }

    private function data(array $extra = []): array
    {
        return array_merge([
            'title'   => $this->title,
            'route'   => $this->route,
            'fields'  => $this->fields(),
            'columns' => $this->columns(),
        ], $extra);
    }

    public function index()
    {
        return view('admin.crud.index', $this->data(['items' => $this->query()->paginate(10)]));
    }

    public function create()
    {
        return view('admin.crud.form', $this->data(['item' => null]));
    }

    public function store(Request $request)
    {
        $data = $this->upload($request, $request->validate($this->rules()));
        $this->model::create($data);

        return redirect()->route($this->route . '.index')
            ->with('success', "Data {$this->title} berhasil ditambahkan.");
    }

    public function edit($id)
    {
        return view('admin.crud.form', $this->data(['item' => $this->model::findOrFail($id)]));
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);
        $data = $this->upload($request, $request->validate($this->rules()), $item);
        $item->update($data);

        return redirect()->route($this->route . '.index')
            ->with('success', "Data {$this->title} berhasil diperbarui.");
    }

    public function destroy($id)
    {
        try {
            $item = $this->model::findOrFail($id);
            if ($this->imageField && $item->{$this->imageField}) {
                Storage::disk('public')->delete($item->{$this->imageField});
            }
            $item->delete();

            return back()->with('success', "Data {$this->title} berhasil dihapus.");
        } catch (\Throwable $e) {
            return back()->with('error', "Data {$this->title} gagal dihapus.");
        }
    }

    // Simpan gambar baru & hapus gambar lama (jika ada)
    private function upload(Request $request, array $data, $item = null): array
    {
        if (! $this->imageField) {
            return $data;
        }

        if ($request->hasFile($this->imageField)) {
            if ($item && $item->{$this->imageField}) {
                Storage::disk('public')->delete($item->{$this->imageField});
            }
            $data[$this->imageField] = $request->file($this->imageField)->store($this->imageFolder, 'public');
        } else {
            unset($data[$this->imageField]); // pertahankan gambar lama
        }

        return $data;
    }
}
