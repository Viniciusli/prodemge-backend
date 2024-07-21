<?php

namespace Tests\Feature;

use App\Enuns\Tipo;
use App\Models\Endereco;
use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnderecosControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_pessoa_enderecos()
    {
        $pessoa = Pessoa::factory()
            ->hasEnderecos(3)
            ->create();

        $response = $this->getJson(route('pessoas.enderecos.index', $pessoa->id));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Endereços listados com sucesso'
            ]);

        $this->assertCount(3, $response->json('data.enderecos'));
    }

    public function test_can_create_endereco()
    {
        $pessoa = Pessoa::factory()->create();

        $payload = [
            'tipo' => Tipo::RESIDENCIAL->value,
            'cep' => '12345-678',
            'logradouro' => 'Rua Exemplo',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Centro',
            'estado' => 'SP',
            'cidade' => 'São Paulo'
        ];

        $response = $this->postJson(route('pessoas.enderecos.store', $pessoa->id), $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Endereço cadastrado com sucesso',
                'data' => [
                    'pessoa' => $pessoa->toArray(),
                    'endereco' => array_merge($payload, ['id' => $response->json('data.endereco.id')])
                ],
            ]);

        $this->assertDatabaseHas('enderecos', $payload);
    }

    public function test_can_list_endereco()
    {
        $pessoa = Pessoa::factory()->create();
        $endereco = Endereco::factory()->create(['pessoa_id' => $pessoa->id]);

        $response = $this->getJson(route('pessoas.enderecos.show', [$pessoa->id, $endereco->id]));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Endereço listado com sucesso',
                'data' => [
                    'pessoa' => $pessoa->toArray(),
                    'endereco' => $endereco->toArray()
                ],
            ]);
    }

    public function test_can_update_endereco()
    {
        $pessoa = Pessoa::factory()->create();
        $endereco = Endereco::factory()->create(['pessoa_id' => $pessoa->id]);

        $data = [
            'tipo' => Tipo::COMERCIAL->value,
            'cep' => '98765-432',
            'logradouro' => 'Avenida Exemplo',
            'numero' => '456',
            'complemento' => 'Sala 2',
            'bairro' => 'Bairro Novo',
            'estado' => 'RJ',
            'cidade' => 'Rio de Janeiro'
        ];

        $response = $this->putJson(route('pessoas.enderecos.update', [$pessoa->id, $endereco->id]), $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Endereço atualizado com sucesso',
                'data' => [
                    'pessoa' => $pessoa->toArray(),
                    'endereco' => array_merge($data, ['id' => $endereco->id])
                ],
            ]);

        $this->assertDatabaseHas('enderecos', $data);
    }

    public function can_delete_endereco()
    {
        $pessoa = Pessoa::factory()->create();
        $endereco = Endereco::factory()->create(['pessoa_id' => $pessoa->id]);

        $response = $this->deleteJson(route('pessoas.enderecos.destroy', [$pessoa->id, $endereco->id]));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Endereço deletado com sucesso',
                'data' => [
                    'pessoa' => $pessoa->toArray(),
                    'endereco' => $endereco->toArray()
                ],
            ]);

        $this->assertDatabaseMissing('enderecos', ['id' => $endereco->id]);
    }
}
