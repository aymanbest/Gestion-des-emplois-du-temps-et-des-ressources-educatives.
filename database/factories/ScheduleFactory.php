<?php

namespace Database\Factories;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time_array = [
            '08:30:00',
            '11:00:00',
            '13:30:00',
            '16:00:00'
        ];

        $end_time_array = [
            '11:00:00',
            '13:30:00',
            '16:00:00',
            '18:30:00'
        ];

        $time_index = $this->faker->numberBetween(0, 3);

        return [
            'class_id' => $this->faker->numberBetween(1, 8),
            'classroom_id' => $this->faker->numberBetween(1, 19),
            'teacher_id' => $this->faker->numberBetween(1, 200),
            'year_id' => $this->faker->numberBetween(1, 2),
            'day_of_week' => $this->faker->dayOfWeek(),
            'start_time' => $start_time_array[$time_index],
            'end_time' => $end_time_array[$time_index],
        ];
    }
}
