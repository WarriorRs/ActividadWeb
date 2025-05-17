<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Paralelo;
class EstudianteTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;
    public function test_example(): void
    {
        $paralelo = Paralelo::factory()->create();
        $response = $this->postJson('/api/estudiantes',[
            'nombre' => 'Sergio Anchundia',
            'cedula' => '1725751505',
            'correo' => 'sergio@gmail.com',
            'paralelo_id' => $paralelo->id,
        ]);

        //$response->assertStatus(200);
        $response->assertStatus(201)
                ->assertJsonFragment(['mensaje' => 'Estudiante creado exitosamente']);
        $this->assertDatabaseHas('estudiantes', [
            'cedula' => '1725751505',
            'correo' => 'sergio@gmail.com',
        ]);
    }
}
