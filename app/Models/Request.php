<?php

namespace App\Models;

use App\Enums\Request\StatusEnum;
use App\Enums\Request\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'guild_id',
        'author_id', //isteği oluşturan kişi
        'type',      // ban,kick timeout
        'object_id', //sunucu üyesi
        'reason',    //istek sebebi
        'status',    //istek durumu
        'admin_id'   //isteği güncelleyecek kişi
    ];

    protected $casts = [
        'status' => StatusEnum::class,
        'type' => TypeEnum::class
    ];

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function admin() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function object() : BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function bans() : HasMany
    {
        return $this->hasMany(Ban::class);
    }

    public function kicks() : HasMany
    {
        return $this->hasMany(Kick::class);
    }

    public function timeouts() : HasMany
    {
        return $this->hasMany(Kick::class);
    }


}
