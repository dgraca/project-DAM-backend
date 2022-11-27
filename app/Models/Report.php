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


    protected $fillable = [
        'title',
        'description',
        'user_id',
        'state',
        'latitude',
        'longitude',
    ];

    
    // user relationship
    public function user() {
        return $this->belongsTo(User::class);
    }

    // report states relationship
    public function state() {
        return $this->belongsTo(ReportState::class);
    }

    // report images relationship
    public function images() {
        return $this->hasMany(ReportImage::class);
    }
    
}
