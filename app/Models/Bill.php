<?php

namespace App\Models;

use App\Enums\GeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'status',
        'room_id',
        'tenant_id'
    ];


    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
}
