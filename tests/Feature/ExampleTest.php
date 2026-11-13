<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_dashboard_renders_its_primary_navigation_and_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('SoraFin')
            ->assertSee('sorafin-logo.png')
            ->assertSee('Suara kasir AI')
            ->assertSee('Transaksi')
            ->assertSee('Laporan SAK EMKM & KUR')
            ->assertSee('Data tetap milik Anda');
    }
}
