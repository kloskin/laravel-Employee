<?php

namespace Database\Factories;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Dietary;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Employee::class;

    public function definition()
    {
        $companies = Company::all();
        $dietaries = Dietary::all();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_id' => $companies->random()->id,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Employee $employee) {
            $employee->dietaryPreferences()->attach(
                Dietary::inRandomOrder()->take(3)->pluck('id')
            );
        });
    }

   /* public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ];
    }*/
}
