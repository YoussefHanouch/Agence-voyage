<?php

namespace Database\Factories;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoitureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voiture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mercedesModels = [
            'A-Class', 'C-Class', 'E-Class', 'S-Class', 'GLA', 'GLC', 'GLE', 'GLS', 'AMG GT', 'EQC'
        ];

        return [
            'marque' => 'Mercedes-Benz',
            'modèle' => $this->faker->randomElement($mercedesModels),
            'année' => $this->faker->year,
            'places_disponibles' => $this->faker->numberBetween(2, 7),
            'prix_par_jour' => $this->faker->randomFloat(2, 50, 500),
            'image' => $this->faker->imageUrl(640, 480, 'cars', true, 'Mercedes', true, 'jpg'),
        ];
    }
}
