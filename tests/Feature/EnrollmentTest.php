<?php

use App\Models\Course;
use App\Models\Participant;
use App\Models\CourseParticipant;

test('halaman index pendaftaran bisa diakses dan menampilkan data', function () {
    $participant = Participant::create([
        'name' => 'Maya Angelina',
        'email' => 'maya.angelina@email.com',
        'phone' => '081234567890',
        'address' => 'Jl. Veteran No. 20, Yogyakarta'
    ]);
    $course = Course::create([
        'name' => 'Desain Grafis',
        'instructor' => 'Andi Wijaya',
        'duration' => 30,
        'description' => 'Pelajari teknik desain grafis dasar menggunakan Adobe Photoshop dan Illustrator.'
    ]);

    CourseParticipant::create([
        'participant_id' => $participant->id,
        'course_id' => $course->id
    ]);

    $this->get(route('enrollments.index'))
        ->assertStatus(200)
        ->assertSee('Maya Angelina');
});

test('halaman form pendaftaran bisa diakses', function () {
    $this->get(route('enrollments.create'))
        ->assertStatus(200)
        ->assertSee('Catat Pendaftaran Baru');
});

test('peserta bisa mendaftar ke satu kelas', function () {
    $participant = Participant::create([
        'name' => 'Nurul Hidayah',
        'email' => 'nurul.hidayah@email.com',
        'phone' => '082198765432',
        'address' => 'Jl. Ahmad Yani No. 15, Surabaya'
    ]);
    $course = Course::create([
        'name' => 'Pemrograman Dasar',
        'instructor' => 'Budi Santoso',
        'duration' => 40,
        'description' => 'Belajar konsep dasar pemrograman untuk pemula, meliputi logika, algoritma, dan pengenalan bahasa pemrograman.'
    ]);

    $this->post(route('enrollments.store'), [
        'participant_id' => $participant->id,
        'course_ids' => [$course->id],
    ])->assertRedirect(route('enrollments.index'));

    $this->assertDatabaseHas('course_participant', [
        'participant_id' => $participant->id,
        'course_id' => $course->id,
    ]);
});

test('peserta bisa mendaftar ke banyak kelas', function () {
    $participant = Participant::create([
        'name' => 'Kiki Amalia',
        'email' => 'kiki.amalia@email.com',
        'phone' => '08123456789',
        'address' => 'Jl. Merdeka No. 10, Jakarta'
    ]);

    $course1 = Course::create([
        'name' => 'Kelas PHP',
        'instructor' => 'Pak Budi',
        'duration' => 10,
        'description' => 'Belajar PHP dasar'
    ]);

    $course2 = Course::create([
        'name' => 'Kelas JavaScript',
        'instructor' => 'Bu Ani',
        'duration' => 12,
        'description' => 'Belajar JS dasar'
    ]);

    $this->post(route('enrollments.store'), [
        'participant_id' => $participant->id,
        'course_ids' => [$course1->id, $course2->id],
    ])->assertRedirect(route('enrollments.index'));

    $this->assertDatabaseHas('course_participant', [
        'participant_id' => $participant->id,
        'course_id' => $course1->id,
    ]);

    $this->assertDatabaseHas('course_participant', [
        'participant_id' => $participant->id,
        'course_id' => $course2->id,
    ]);
});

test('peserta bisa membatalkan pendaftaran', function () {
    $participant = Participant::create([
        'name' => 'Oki Setiawan',
        'email' => 'oki.setiawan@email.com',
        'phone' => '085612345678',
        'address' => 'Jl. Kemerdekaan No. 30, Medan'
    ]);
    $course = Course::create([
        'name' => 'Editing Video',
        'instructor' => 'Citra Dewi',
        'duration' => 35,
        'description' => 'Pelajari teknik editing video profesional menggunakan software populer seperti Adobe Premiere dan DaVinci Resolve.'
    ]);

    $enrollment = CourseParticipant::create([
        'participant_id' => $participant->id,
        'course_id' => $course->id
    ]);

    $this->delete(route('enrollments.destroy', $enrollment->id))
        ->assertRedirect();

    $this->assertDatabaseMissing('course_participant', ['id' => $enrollment->id]);
});
