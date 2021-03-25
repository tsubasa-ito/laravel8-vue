<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageControllerTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {

        User::factory()->create([
            'email' => 'Indexl123@test.com',
            'password'  => bcrypt('IndexTest456')
        ]);

        $test_message = Message::factory()->create([
            'content' => 'IndexTest1Content',
            'user_id' => 1
        ]);

        $response = $this->get(route('api.index'));

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'content' => 'IndexTest1Content',
                'user_id' => 1
            ]);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'email' => 'StoreYouser123@test.com',
            'password'  => bcrypt('StoreYouser456')
        ]);

        $data = [
            'message' => 'StoreTest2Content',
            'user_id' => 2,
        ];

        $response = $this->post(route('api.store'), $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'content' => 'StoreTest2Content',
                'user_id' => 2,
            ]);
    }

    public function testDelete()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'email' => 'DeleteYouser123@test.com',
            'password'  => bcrypt('DeleteYouser456')
        ]);

        $delete_message = Message::factory()->create([
            'content' => 'DeleteTest3Content',
            'user_id' => 3
        ]);

        $response = $this->delete(route('api.delete', [$delete_message->id]));

        $response->assertNoContent();
    }
}
