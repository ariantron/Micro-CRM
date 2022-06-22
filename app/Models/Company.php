<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getLogoPath()
    {
        if (str_starts_with($this->logo_path, 'https'))
            return $this->logo_path;
        return asset('storage/' . $this->logo_path);
    }
}
