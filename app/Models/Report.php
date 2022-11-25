<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    // table
    protected $table = 'reports';

    // primary key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    function users() {
        return $this->belongsTo(User::class);
    }
    
}
