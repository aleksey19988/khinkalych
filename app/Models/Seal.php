<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $guest_id ID гостя
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property Guest $guest
 */
class Seal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['guest_id'];

    public function guest(): HasOne
    {
        return $this->hasOne(Guest::class, 'id', 'guest_id');
    }
}
