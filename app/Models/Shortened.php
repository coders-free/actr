<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Shortened extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'slug',
        'qr_code',
        'user_id'
    ];

    public function link(): Attribute
    {
        return new Attribute(
            get: fn() => route('shortened.show', $this),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    //Route Model Binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
