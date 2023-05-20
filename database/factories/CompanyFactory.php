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
            'name' => $this->faker->text($this->faker->numberBetween(5, 200)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'status' => $this->faker->text($this->faker->numberBetween(5, 20)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_by' => $this->faker->text($this->faker->numberBetween(5, 40)),
            'updated_by' => $this->faker->text($this->faker->numberBetween(5, 40)),
            'deleted_by' => $this->faker->text($this->faker->numberBetween(5, 40))
        ];
    }
}
