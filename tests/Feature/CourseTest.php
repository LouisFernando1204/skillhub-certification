<?php

use App\Models\Course;

test('halaman index kelas bisa diakses dan menampilkan data', function () {
    Course::create([
        'name' => 'Desain Grafis',
        'instructor' => 'Andi Wijaya',
        'duration' => 30
    ]);

    $this->get(route('courses.index'))
        ->assertStatus(200)
        ->assertSee('Desain Grafis');
});

test('halaman form tambah kelas bisa diakses', function () {
    $this->get(route('courses.create'))
        ->assertStatus(200)
        ->assertSee('Buat Kelas Baru');
});

test('bisa menambah kelas baru', function () {
    $data = [
        'name' => 'Pemrograman Dasar',
        'instructor' => 'Budi Santoso',
        'duration' => 40,
        'description' => 'Belajar konsep dasar pemrograman untuk pemula, meliputi logika, algoritma, dan pengenalan bahasa pemrograman.'
    ];

    $this->post(route('courses.store'), $data)
        ->assertRedirect(route('courses.index'));

    $this->assertDatabaseHas('courses', ['name' => 'Pemrograman Dasar']);
});

test('halaman detail kelas bisa diakses', function () {
    $course = Course::create([
        'name' => 'Editing Video',
        'instructor' => 'Citra Dewi',
        'description' => 'Pelajari teknik editing video profesional menggunakan software populer seperti Adobe Premiere dan DaVinci Resolve.'
    ]);

    $this->get(route('courses.show', $course->id))
        ->assertStatus(200)
        ->assertSee('Editing Video');
});

test('halaman form edit kelas bisa diakses', function () {
    $course = Course::create([
        'name' => 'Public Speaking',
        'instructor' => 'Deni Pratama',
        'duration' => 25
    ]);

    $this->get(route('courses.edit', $course->id))
        ->assertStatus(200)
        ->assertSee('Public Speaking');
});

test('bisa mengupdate data kelas', function () {
    $course = Course::create([
        'name' => 'Desain Grafis Pemula',
        'instructor' => 'Eka Putra',
        'duration' => 20
    ]);

    $this->put(route('courses.update', $course->id), [
        'name' => 'Desain Grafis Profesional',
        'instructor' => 'Eka Putra',
        'duration' => 35,
        'description' => 'Kursus desain grafis tingkat lanjut untuk menjadi desainer profesional.'
    ])->assertRedirect(route('courses.index'));

    $this->assertDatabaseHas('courses', ['name' => 'Desain Grafis Profesional']);
});

test('bisa menghapus kelas', function () {
    $course = Course::create([
        'name' => 'Public Speaking untuk Pemula',
        'instructor' => 'Farah Amalia',
        'duration' => 15
    ]);

    $this->delete(route('courses.destroy', $course->id))
        ->assertRedirect(route('courses.index'));

    $this->assertDatabaseMissing('courses', ['name' => 'Public Speaking untuk Pemula']);
});
