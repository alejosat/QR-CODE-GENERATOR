<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'qr_code_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
