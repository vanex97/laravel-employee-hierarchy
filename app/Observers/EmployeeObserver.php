<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    /**
     * @param  Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
    {
        $this->setCreatedAdmin($employee);
        $this->setPhone($employee);
    }

    /**
     * @param Employee $employee
     */
    public function updating(Employee $employee)
    {
        $this->setUpdatedAdmin($employee);
        $this->setPhone($employee);
    }

    public function deleting(Employee $employee)
    {
        $employee->image()->delete();
    }

    /**
     * @param Employee $employee
     */
    protected function setPhone(Employee $employee)
    {
        if ($employee->isDirty('phone_number')) {
            $employee->phone_number =
                phone($employee->phone_number, 'UA', 'international');
        }
    }

    /**
     * @param Employee $employee
     */
    protected function setCreatedAdmin(Employee $employee)
    {
        $employee->admin_created_id = auth()->user()->id ?? Employee::UNKNOWN_USER;
        $this->setUpdatedAdmin($employee);
    }

    /**
     * @param Employee $employee
     */
    protected function setUpdatedAdmin(Employee $employee)
    {
        $employee->admin_updated_id = auth()->user()->id ?? Employee::UNKNOWN_USER;
    }

}
