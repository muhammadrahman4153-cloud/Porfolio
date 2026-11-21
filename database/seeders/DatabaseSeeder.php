<?php
namespace Database\Seeders;

use App\Models\{Category, Education, Experience, Profile, Project, Skill, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin (ubah setelah login pertama!)
        User::updateOrCreate(
            ['email' => 'admin@portfolio.test'],
            ['name' => 'Admin', 'password' => Hash::make('password123')]
        );

        Profile::firstOrCreate([], [
            'name' => 'Nama Anda',
            'title' => 'Web Developer',
            'bio' => 'Halo! Saya seorang web developer yang suka membangun aplikasi web yang rapi dan mudah digunakan. Ubah teks ini lewat dashboard admin.',
            'email' => 'email@example.com',
            'phone' => '08123456789',
            'address' => 'Semarang, Jawa Tengah',
            'github' => 'https://github.com/',
            'linkedin' => 'https://linkedin.com/',
            'instagram' => 'https://instagram.com/',
        ]);

        $web = Category::firstOrCreate(['name' => 'Web']);
        Category::firstOrCreate(['name' => 'Mobile']);
        Category::firstOrCreate(['name' => 'Desktop']);

        foreach ([
            ['PHP', 'Programming', 85], ['JavaScript', 'Programming', 75],
            ['Laravel', 'Programming', 80], ['UI Design', 'Design', 70],
            ['Figma', 'Design', 65], ['MySQL', 'Database', 80],
        ] as [$n, $c, $p]) {
            Skill::firstOrCreate(['name' => $n], ['category' => $c, 'percentage' => $p]);
        }

        Education::firstOrCreate(['school' => 'Universitas Contoh'], [
            'level' => 'S1', 'major' => 'Teknik Informatika', 'start_year' => 2022, 'end_year' => null,
            'description' => 'Fokus pada pengembangan web dan basis data.',
        ]);

        Experience::firstOrCreate(['organization' => 'Himpunan Mahasiswa Informatika'], [
            'position' => 'Staf Divisi Teknologi', 'start_year' => 2023, 'end_year' => 2024,
            'description' => 'Mengelola website organisasi.',
        ]);

        Project::firstOrCreate(['title' => 'Aplikasi Contoh'], [
            'category_id' => $web->id,
            'description' => 'Contoh proyek. Ganti atau hapus lewat dashboard admin.',
            'technologies' => 'Laravel, MySQL, Bootstrap',
            'github_url' => 'https://github.com/',
        ]);
    }
}
