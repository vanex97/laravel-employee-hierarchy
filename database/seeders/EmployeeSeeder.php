<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Position::all()->isEmpty()) {
            Position::factory(10)->create();
        }
        $this->createHierarchySet(50000, 5);
    }

    /**
     * @param $count
     * @param $level
     */
    private function createHierarchySet($count, $level)
    {
        $count = $count / $level;
        for($i = 0; $i < $count; $i++) {
            $this->createHierarchyLine($level);
        }
    }

    /**
     * @param $level
     * @return Model|null
     */
    private function createHierarchyLine($level): ?Model
    {
        if ($level === 1) {
            return Employee::factory()->createOne();
        }

        return Employee::factory()
            ->for($this->createHierarchyLine(--$level), 'head')
            ->create();
    }

}
