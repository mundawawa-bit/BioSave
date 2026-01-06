<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    use HasFactory;

    protected $table = 'about_settings';

    protected $fillable = [
        'company_name',
        'description',
        'vision',
        'mission',
        'email',
        'phone',
        'address',
    ];
}
