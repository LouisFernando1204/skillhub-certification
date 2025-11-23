<?php

use App\Models\Course;
use App\Models\CourseParticipant;
use App\Models\Participant;

test('halaman index peserta bisa diakses dan menampilkan data', function () {
    Participant::create([
        'name' => 'Gita Sari',
        'email' => 'gita.sari@email.com',
        'phone' => '081234567890',
        'address' => 'Jl. Merdeka No. 45, Jakarta Pusat'
    ]);

    $response = $this->get(route('participants.index'));

    $response->assertStatus(200);
    $response->assertSee('Gita Sari');
});

test('halaman form tambah peserta bisa diakses', function () {
    $this->get(route('participants.create'))
        ->assertStatus(200)
        ->assertSee('Tambah Peserta');
});

test('bisa menambah peserta baru', function () {
    $data = [
        'name' => 'Hendra Kusuma',
        'email' => 'hendra.kusuma@email.com',
        'phone' => '082198765432',
        'address' => 'Jl. Sudirman No. 88, Jakarta Selatan',
    ];

    $this->post(route('participants.store'), $data)
        ->assertRedirect(route('participants.index'));

    $this->assertDatabaseHas('participants', ['email' => 'hendra.kusuma@email.com']);
});

test('halaman detail peserta bisa diakses', function () {
    $participant = Participant::create([
        'name' => 'Indra Firmansyah',
        'email' => 'indra.firmansyah@email.com',
        'phone' => '085612345678',
        'address' => 'Jl. Gatot Subroto No. 12, Bandung'
    ]);

    $this->get(route('participants.show', $participant->id))
        ->assertStatus(200)
        ->assertSee('Indra Firmansyah');
});

test('halaman detail peserta menampilkan daftar kelas yang diikuti', function () {
    $participant = Participant::create([
        'name' => 'Budi Santoso',
        'email' => 'budisantoso@email.com',
        'phone' => '081234567890',
        'address' => 'Jl. Warung No. 10, Jakarta'
    ]);

    $course = Course::create([
        'name' => 'Kelas Laravel',
        'instructor' => 'Taylor Otwell',
        'duration' => 20,
        'description' => 'Framework PHP terbaik'
    ]);

    CourseParticipant::create([
        'participant_id' => $participant->id,
        'course_id' => $course->id
    ]);

    $this->get(route('participants.show', $participant->id))
        ->assertStatus(200)
        ->assertSee('Budi Santoso')
        ->assertSee('Kelas Laravel');
});

test('halaman form edit peserta bisa diakses', function () {
    $participant = Participant::create([
        'name' => 'Louis Fernando',
        'email' => 'louis.fernando@email.com',
        'phone' => '087765432109',
        'address' => 'Jl. Diponegoro No. 25, Surabaya'
    ]);

    $this->get(route('participants.edit', $participant->id))
        ->assertStatus(200)
        ->assertSee('Louis Fernando');
});

test('bisa mengupdate data peserta', function () {
    $participant = Participant::create([
        'name' => 'Kartika Putri',
        'email' => 'kartika.putri@email.com',
        'phone' => '081223344556',
        'address' => 'Jl. Asia Afrika No. 10, Bandung'
    ]);

    $this->put(route('participants.update', $participant->id), [
        'name' => 'Kartika Putri Dewi',
        'email' => 'kartika.dewi@email.com',
        'phone' => '081223344557',
        'address' => 'Jl. Raya Dago No. 100, Bandung'
    ])->assertRedirect(route('participants.index'));

    $this->assertDatabaseHas('participants', ['name' => 'Kartika Putri Dewi']);
});

test('bisa menghapus peserta', function () {
    $participant = Participant::create([
        'name' => 'Lisa Maharani',
        'email' => 'lisa.maharani@email.com',
        'phone' => '089876543210',
        'address' => 'Jl. Pahlawan No. 55, Semarang'
    ]);

    $this->delete(route('participants.destroy', $participant->id))
        ->assertRedirect(route('participants.index'));

    $this->assertDatabaseMissing('participants', ['email' => 'lisa.maharani@email.com']);
});
