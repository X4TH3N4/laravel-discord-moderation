<?php

namespace App\Models;

<<<<<<< HEAD
use App\Filament\Home\Resources\CategoryResource;
=======
use App\Filament\Roof\Resources\CategoryResource;
>>>>>>> origin/main
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function categories() : HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function channels() : HasMany
    {
        return $this->hasMany(Channel::class);
    }

}
