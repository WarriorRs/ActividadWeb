<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Paralelo;

class ParaleloTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;

    public function test_example(): void
    {
        // paralelos de prueba
        Paralelo::factory()->create(['nombre' => 'P1']);
        Paralelo::factory()->create(['nombre' => 'P2']);
        
        $response = $this->getJson('/api/paralelos');
        
        $response->assertStatus(200)
                ->assertJsonFragment(['nombre' => 'P1'])
                ->assertJsonFragment(['nombre' => 'P2']);
    }
}
