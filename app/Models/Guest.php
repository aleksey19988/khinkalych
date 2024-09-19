<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name Имя гостя
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
