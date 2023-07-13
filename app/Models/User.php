<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'phone',
        'region_id',
        'district_id',
        'quarter_id',
        'ward_id',
        'block_id',
        'disease',
        'doctor',
        'arrival_date',
        'departure_date',
        'reception_id',
    ];

    protected $table = "users";

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function quarter(){
        return $this->belongsTo(Quarter::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function reception(){
        return $this->belongsTo(Reception::class);
    }
}
