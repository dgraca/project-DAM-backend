<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportState extends Model
{
    use HasFactory;

    // table
    protected $table = 'report_states';

    // primary key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    
    // reports relationship
    public function reports() {
        return $this->hasMany(Report::class);
    }
}
