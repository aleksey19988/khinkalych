<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $department_id ID подразделения/филиала
 * @property int $guest_id ID гостя
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class DepartmentGuest extends Model
{
    use HasFactory;
    use SoftDeletes;
}
