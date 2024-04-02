<?php

namespace App\Models;

use App\Models\Scopes\ActiveUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::createFromDate($value)->format('d-M-Y');
    }

    public function scopeSearch($query, $name = ''){
        return $query->where('name','LIKE','%'.$name.'%');
    }

    protected static function booted():void
    {
        static::addGlobalScope(new ActiveUsers());
    }

}
