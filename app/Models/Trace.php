<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    use HasFactory;

    protected $fillable = ["action","user_id"];

    public function user()
    {
      return $this->belongsTo("App\Models\User");
    }
}
