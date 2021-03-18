<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {
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

        $this->assertDatabaseHas('messages', [
            'content' => 'IndexTest1Content',
            'user_id' => 1
        ]);

        $response->assertJson([
            'data'=> [
                [
                    'content' => 'IndexTest1Content',
                    'user_id' => 1
                ]
            ]
        ]);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'message' => 'IndexTest2Content',
            'user_id' => 2,
        ];


        $response = $this->post(route('api.store'), $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'content' => 'IndexTest2Content',
                'user_id' => 2,
            ]);
    }
}
