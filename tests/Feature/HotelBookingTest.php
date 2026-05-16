<?php

namespace Tests\Feature;

use App\Models\HotelBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelBookingTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'full_name'   => 'Jane Doe',
            'email'       => 'jane@example.com',
            'phone'       => '+1-555-0100',
            'age'         => 30,
            'country'     => 'USA',
            'city'        => 'New York',
            'room_type'   => 'double',
            'return_date' => now()->addDays(10)->format('Y-m-d'),
            'return_time' => '14:00',
            'message'     => 'Non-smoking room please.',
        ], $overrides);
    }

    public function test_hotel_booking_page_loads()
    {
        $this->get('/bookhotel')->assertStatus(200);
    }

    public function test_valid_submission_saves_to_database()
    {
        $this->post('/bookhotel', $this->validPayload())
             ->assertRedirect();

        $this->assertDatabaseHas('hotel_bookings', [
            'email'     => 'jane@example.com',
            'city'      => 'New York',
            'room_type' => 'double',
        ]);
    }

    public function test_submission_requires_full_name()
    {
        $this->post('/bookhotel', $this->validPayload(['full_name' => '']))
             ->assertSessionHasErrors('full_name');
    }

    public function test_submission_requires_valid_email()
    {
        $this->post('/bookhotel', $this->validPayload(['email' => 'not-an-email']))
             ->assertSessionHasErrors('email');
    }

    public function test_submission_rejects_age_below_18()
    {
        $this->post('/bookhotel', $this->validPayload(['age' => 15]))
             ->assertSessionHasErrors('age');
    }

    public function test_submission_requires_valid_room_type()
    {
        $this->post('/bookhotel', $this->validPayload(['room_type' => 'penthouse']))
             ->assertSessionHasErrors('room_type');
    }

    public function test_submission_rejects_past_return_date()
    {
        $this->post('/bookhotel', $this->validPayload(['return_date' => '2000-01-01']))
             ->assertSessionHasErrors('return_date');
    }

    public function test_authenticated_user_id_is_stored()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user)
             ->post('/bookhotel', $this->validPayload());

        $this->assertDatabaseHas('hotel_bookings', [
            'email'   => 'jane@example.com',
            'user_id' => $user->id,
        ]);
    }
}
