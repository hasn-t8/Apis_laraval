<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $table = 'signups';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'username', 'password'];
    use HasFactory;
}
