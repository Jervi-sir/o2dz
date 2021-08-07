<?php

namespace App\Models;

use App\Models\Cost;
use App\Models\Type;
use App\Models\User;
use App\Models\Report;
use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

}
