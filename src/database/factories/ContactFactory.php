<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{

    protected $model = Contact::class;

    public function definition(): array
    {
        $faker  = $this->faker;
        $gender = $faker->randomElement([1, 2, 3]);

        return [
            'last_name'   => $faker->lastName,
            'first_name'  => $faker->firstName,
            'gender'      => $gender,
            'email'       => $faker->unique()->safeEmail,
            'tel'         => $faker->numerify('0##########'),
            'address'     => $faker->address,
            'building'    => $faker->optional()->secondaryAddress,
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? 1,
            'content'     => mb_substr($faker->realText(120), 0, 120),
        ];
    }
}
