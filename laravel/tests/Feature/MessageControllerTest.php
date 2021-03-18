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
        // `messages` テーブルにデータを作成
        $test_message = Message::factory()->create([
            'content' => 'IndexTest1Content',
            'user_id' => 1
        ]);

        // GET リクエスト
        $response = $this->get(route('api.index'));

        // 1件のレスポンスがある
        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'content' => 'IndexTest1Content',
                'user_id' => 1
            ]);

        // DBのデータチェック
        $this->assertDatabaseHas('messages', [
            'content' => 'IndexTest1Content',
            'user_id' => 1
        ]);

        // レスポンスの内容を取得して JSON デコードする
        $response->assertJson([
            'data'=> [
                [
                    'content' => 'IndexTest1Content',
                    'user_id' => 1
                ]
            ]
        ]);
    }
}
