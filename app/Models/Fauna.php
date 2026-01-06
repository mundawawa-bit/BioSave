<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fauna extends Model
{
    use HasFactory;

    protected $table = 'fauna';

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

    // Fauna dibuat oleh siapa (user)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
