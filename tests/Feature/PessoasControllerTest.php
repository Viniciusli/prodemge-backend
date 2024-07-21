<?php

namespace Tests\Feature;

use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoasControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_list_all_pessoas()
    {
        Pessoa::factory()->count(3)->create();

        $response = $this->getJson(route('pessoas.index'));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Pessoas listadas com sucesso'
            ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_store_pessoa()
    {
        $payload = [
            'nome' => 'pessoa teste',
            'nome_social' => 'teste',
            'cpf' => '123.456.789-00',
            'nome_pai' => 'Teste da Silva',
            'nome_mae' => 'Teste da Silva',
            'telefone' => '(11) 91234-5678',
            'email' => 'teste@example.com',
        ];

        $response = $this->postJson(route('pessoas.store'), $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Pessoa cadastrada com sucesso',
                'data' => [
                    'nome' => 'pessoa teste',
                    'nome_social' => 'teste',
                    'cpf' => '123.456.789-00',
                    'nome_pai' => 'Teste da Silva',
                    'nome_mae' => 'Teste da Silva',
                    'telefone' => '(11) 91234-5678',
                    'email' => 'teste@example.com',
                ]
            ]);

        $this->assertDatabaseHas('pessoas', $payload);
    }

    public function test_validate_nome_field()
    {
        $paylaod = [
            'nome_social' => 'teste',
            'cpf' => '123.456.789-00',
            'nome_pai' => 'Teste da Silva',
            'nome_mae' => 'Teste da Silva',
            'telefone' => '(11) 91234-5678',
            'email' => 'teste@example.com',
        ];

        $response = $this->postJson(route('pessoas.store'), $paylaod);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nome']);
    }

    public function test_pessoa_not_found()
    {
        $response = $this->getJson(route('pessoas.show', 999));

        $response->assertStatus(404);
    }

    public function test_can_show_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $response = $this->getJson(route('pessoas.show', $pessoa));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Pessoa listada com sucesso',
                'data' => [
                    'id' => $pessoa->id,
                ]
            ]);
    }

    public function test_can_update_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $payload = [
            'nome' => 'pessoa teste update',
        ];

        $response = $this->putJson(route('pessoas.update', $pessoa), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Pessoa atualizada com sucesso',
                'data' => [
                    'nome' => 'pessoa teste update',
                ]
            ]);
    }

    public function test_can_delete_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $response = $this->deleteJson(route('pessoas.destroy', $pessoa));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Pessoa deletada com sucesso',
            ]);

        $this->assertDatabaseMissing('pessoas', [
            'id' => $pessoa->id,
        ]);
    }
}
