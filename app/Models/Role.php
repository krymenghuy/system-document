<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
     protected $fillable = [
<<<<<<< HEAD
        'superadmin',
=======
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
        'admin',
        'lecturer',
        'student',
        'outsider',

    ];
}
