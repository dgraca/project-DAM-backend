<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    use HasFactory;

    // table
    protected $table = 'report_images';

    // primary key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    
    // report relationship
    public function report() {
        return $this->belongsTo(Report::class);
    }
}
