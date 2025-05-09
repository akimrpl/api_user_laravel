<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_member_api()
    {
        // Data member baru
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 30
        ];

        // Kirim request POST ke API
        $response = $this->postJson('/api/members', $data);

        // Periksa apakah response status 201 dan data member ada di database
        $response->assertStatus(201);
        $this->assertDatabaseHas('members', $data);
    }

    public function test_get_all_members_api()
    {
        // Buat beberapa member
        Member::factory()->count(5)->create();

        // Kirim request GET ke API
        $response = $this->getJson('/api/members');

        // Periksa apakah response status 200 dan jumlah member yang dikembalikan sesuai
        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_update_member_api()
    {
        // Buat satu member
        $member = Member::factory()->create();

        // Data yang akan di-update
        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'age' => 35,
        ];

        // Kirim request PUT ke API
        $response = $this->putJson("/api/members/{$member->id}", $updatedData);

        // Periksa response dan database
        $response->assertStatus(200);
        $this->assertDatabaseHas('members', $updatedData);
    }

    public function test_delete_member_api()
    {
        // Buat satu member
        $member = Member::factory()->create();

        // Kirim request DELETE ke API
        $response = $this->deleteJson("/api/members/{$member->id}");

        // Periksa response dan database
        $response->assertStatus(200);
        $this->assertDatabaseMissing('members', [
            'id' => $member->id
        ]);
    }

    public function test_get_member_by_id_api()
    {
        // Buat satu member
        $member = Member::factory()->create();

        // Kirim request GET ke API untuk mendapatkan member berdasarkan ID
        $response = $this->getJson("/api/members/{$member->id}");

        // Periksa apakah response status 200 dan data member sesuai
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $member->id,
            'name' => $member->name,
            'email' => $member->email,
            'age' => $member->age,
        ]);
    }

}
