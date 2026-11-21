<?php
namespace App\Http\Controllers;

use App\Models\{Category, Certificate, Education, Experience, Message, Profile, Project, Skill};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'profile'  => Profile::first(),
            'projects' => Project::with('category')->latest()->take(3)->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'profile'     => Profile::first(),
            'educations'  => Education::orderByDesc('start_year')->get(),
            'experiences' => Experience::orderByDesc('start_year')->get(),
            'skills'      => Skill::orderByDesc('percentage')->take(8)->get(),
        ]);
    }

    public function skills()
    {
        return view('pages.skills', [
            'groups' => Skill::orderByDesc('percentage')->get()->groupBy('category'),
        ]);
    }

    public function projects(Request $request)
    {
        $projects = Project::with('category')
            ->when($request->q, function ($query, $keyword) {
                $query->where(function ($w) use ($keyword) {
                    $w->where('title', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%")
                      ->orWhere('technologies', 'like', "%{$keyword}%");
                });
            })
            ->when($request->category, fn ($query, $id) => $query->where('category_id', $id))
            ->latest()->paginate(6)->withQueryString();

        return view('pages.projects', [
            'projects'   => $projects,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function certificates()
    {
        return view('pages.certificates', [
            'certificates' => Certificate::orderByDesc('issued_date')->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', ['profile' => Profile::first()]);
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Message::create($data);

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil terkirim. Terima kasih!');
    }

    public function downloadCv()
    {
        $profile = Profile::first();
        abort_unless($profile && $profile->cv && Storage::disk('public')->exists($profile->cv), 404, 'CV belum diunggah.');

        return Storage::disk('public')->download($profile->cv, 'CV-' . str($profile->name)->slug() . '.pdf');
    }
}
