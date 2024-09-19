<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title Наименование подразделения/филиала
 * @property string $district Наименование района
 * @property string $microdistrict Наименование микрорайона
 * @property string $street Наименование улицы
 * @property int $house Номер дома
 * @property int $city_id ID города
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
}
