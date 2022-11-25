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

    
    // users relationship
    public function users() {
        return $this->belongsTo(User::class);
    }

    // report states relationship
    public function reportState() {
        return $this->hasOne(ReportState::class);
    }

    // report images relationship
    public function reportImages() {
        return $this->hasMany(ReportImage::class);
    }
    
}
