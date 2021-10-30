<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'name' => $this->faker->word,
        'zipCode' => $this->faker->word,
        'street' => $this->faker->word,
        'district' => $this->faker->word,
        'complement' => $this->faker->word,
        'city' => $this->faker->word,
        'state' => $this->faker->word,
        'phone' => $this->faker->word,
        'number_home' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
