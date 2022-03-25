<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public static function booted()
    {
        static::creating(function($position) {
            $position->admin_created_id = Auth::id();
            $position->admin_updated_id = Auth::id();
        });

        static::updating(function($position) {
            $position->admin_updated_id = Auth::id();
        });
    }
}
