<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasUlids;

    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    protected $table = "repositories";

    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        "name",
        "description",
        "owner_id",
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function repositories(): HasMany
    {
        return $this->hasMany(Repository::class, "project_id");
    }
}
