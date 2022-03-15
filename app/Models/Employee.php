<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function head()
    {
        return $this->belongsTo(Employee::class, 'head_id');
    }

    public function heads()
    {
        return $this->belongsTo(Employee::class, 'head_id')->with('head');
    }

    public function subordinate()
    {
        return $this->hasMany(Employee::class, 'head_id');
    }

    public function subordinates()
    {
        return $this->hasOne(Employee::class, 'head_id')->with('subordinate');
    }

}
