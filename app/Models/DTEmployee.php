<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTEmployee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function position()
    {
        return $this->belongsTo(MPosition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkInToday()
    {
        return $this->hasOne(DTAttendance::class, 'employee_id', 'id')->whereDate('check_in', now());
    }
}
