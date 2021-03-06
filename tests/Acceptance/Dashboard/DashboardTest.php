<?php

namespace Tests\Feature\DashboardTest;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_the_dashboard()
    {
        $this->withoutExceptionHandling();

        $session = factory(Session::class)->create([
            'started_at' => '2018-01-01 12:00:00',
            'ended_at'   => '2018-01-01 13:00:00',
        ]);

        Carbon::setTestNow(Carbon::parse('2018-01-02'));

        $this->actingAsUser();

        $response = $this->get(route('home'));

        $response->assertSuccessful();
        $response->assertViewIs('home');

        Carbon::setTestNow();
    }
}
