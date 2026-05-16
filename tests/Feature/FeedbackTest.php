<?php

namespace Tests\Feature;

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name'    => 'John Smith',
            'email'   => 'john@example.com',
            'subject' => 'Flight Experience',
            'message' => 'Excellent service, very smooth flight!',
        ], $overrides);
    }

    public function test_valid_feedback_is_saved()
    {
        $this->postJson('/feedback', $this->validPayload())
             ->assertOk()
             ->assertJson(['success' => true]);

        $this->assertDatabaseHas('feedback', [
            'email'   => 'john@example.com',
            'subject' => 'Flight Experience',
        ]);
    }

    public function test_feedback_requires_name()
    {
        $this->postJson('/feedback', $this->validPayload(['name' => '']))
             ->assertUnprocessable()
             ->assertJsonValidationErrors('name');
    }

    public function test_feedback_requires_valid_email()
    {
        $this->postJson('/feedback', $this->validPayload(['email' => 'bad']))
             ->assertUnprocessable()
             ->assertJsonValidationErrors('email');
    }

    public function test_feedback_requires_message()
    {
        $this->postJson('/feedback', $this->validPayload(['message' => '']))
             ->assertUnprocessable()
             ->assertJsonValidationErrors('message');
    }

    public function test_feedback_requires_subject()
    {
        $this->postJson('/feedback', $this->validPayload(['subject' => '']))
             ->assertUnprocessable()
             ->assertJsonValidationErrors('subject');
    }

    public function test_authenticated_user_id_is_stored()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user)
             ->postJson('/feedback', $this->validPayload());

        $this->assertDatabaseHas('feedback', [
            'email'   => 'john@example.com',
            'user_id' => $user->id,
        ]);
    }
}
