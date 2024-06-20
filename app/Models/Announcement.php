<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tenement_id'
    ];



    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function announcementFeeds(){
        return $this->hasMany(AnnouncementFeed::class);
    }
}
