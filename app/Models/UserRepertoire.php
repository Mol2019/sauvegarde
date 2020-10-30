<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRepertoire extends Model
{
    use HasFactory;
    protected $table = "user_repertoire";

    protected $fillable = ["user_id","repertoire_id"];
}
