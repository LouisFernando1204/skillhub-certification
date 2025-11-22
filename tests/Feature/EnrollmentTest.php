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
        'duration' => 30
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

test('peserta bisa mendaftar ke kelas', function () {
    $participant = Participant::create([
        'name' => 'Nurul Hidayah',
        'email' => 'nurul.hidayah@email.com',
        'phone' => '082198765432',
        'address' => 'Jl. Ahmad Yani No. 15, Surabaya'
    ]);
    $course = Course::create([
        'name' => 'Pemrograman Dasar',
        'instructor' => 'Budi Santoso',
        'duration' => 40
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
        'duration' => 35
    ]);

    $enrollment = CourseParticipant::create([
        'participant_id' => $participant->id,
        'course_id' => $course->id
    ]);

    $this->delete(route('enrollments.destroy', $enrollment->id))
        ->assertRedirect();

    $this->assertDatabaseMissing('course_participant', ['id' => $enrollment->id]);
});
