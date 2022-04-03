<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headLevel1 = Employee::factory(1)->createOne();
        $subordinatesLevel1 = Employee::factory(5)->make();
        $this->setHeadSubordinates($headLevel1, $subordinatesLevel1);

        $headLevel2 = $subordinatesLevel1->first();
        $subordinatesLevel2 = Employee::factory(5)->make();
        $this->setHeadSubordinates($headLevel2, $subordinatesLevel2);
    }

    /**
     * @param $head
     * @param $subordinates
     */
    private function setHeadSubordinates($head, $subordinates)
    {
        foreach ($subordinates as $subordinate) {
            $subordinate->appendToNode($head)->save();
        }
    }
}
