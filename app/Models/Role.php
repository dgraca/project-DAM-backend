<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // table
    protected $table = 'roles';

    // primary key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;
    

    // users relationship
    public function users() {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
