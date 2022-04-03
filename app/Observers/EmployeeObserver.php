<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    /**
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
    {
        $employee->admin_created_id = auth()->user()->id;
        $employee->admin_updated_id = auth()->user()->id;
        $this->setPhone($employee);
    }

    /**
     * @param Employee $employee
     */
    public function updating(Employee $employee)
    {
        $employee->admin_updated_id = auth()->user()->id;
        $this->setPhone($employee);
    }

    /**
     *
     * @param Employee $employee
     */
    protected function setPhone(Employee $employee)
    {
        if ($employee->isDirty('phone_number')) {
            $employee->phone_number =
                phone($employee->phone_number, 'UA', 'international');
        }
    }

}
