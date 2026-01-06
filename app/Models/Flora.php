<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flora extends Model
{
    use HasFactory;

    protected $table = 'flora';

    protected $fillable = [
        'name',
        'scientific_name',
        'family',
        'habitat',
        'description',
        'status',
        'image_path',
        'created_by',
        'approval_status'
    ];

    // Flora dibuat oleh siapa (user)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
