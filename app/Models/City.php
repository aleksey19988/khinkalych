<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title Наименование города
 * @property int $region_id ID региона
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class City extends Model
{
    use HasFactory;
    use SoftDeletes;
}
