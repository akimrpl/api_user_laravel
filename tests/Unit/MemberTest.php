<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Member;

class MemberTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_member_can_be_created()
    {
        // Buat data member baru
        $member = Member::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 30
        ]);

        // Periksa apakah data member benar-benar ada di database
        $this->assertDatabaseHas('members', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 30
        ]);
    }
}
