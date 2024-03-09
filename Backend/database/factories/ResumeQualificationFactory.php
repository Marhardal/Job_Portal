<?php

namespace Database\Factories;

use App\Models\Certificate;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResumeQualification>
 */
class ResumeQualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resume_id' => Resume::get()->random()->id,
            'certificate_id' => Certificate::get()->random()->id,
        ];
    }
}
