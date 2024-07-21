<?php

namespace Database\Factories;

use App\Enuns\Tipo;
use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pessoa_id' => Pessoa::factory(),
            'tipo' => $this->faker->randomElement(Tipo::cases()),
            'cep' => substr($this->faker->postcode(), 0, 8),
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->secondaryAddress(),
            'bairro' => 'Parque Verde',
            'estado' => 'Pará',
            'cidade' => 'Belém',
        ];
    }
}
