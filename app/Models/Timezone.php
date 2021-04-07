<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Timezone
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereName($value)
 */
class Timezone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'display_name'];

    public $timestamps = false;

    public static function getTimezoneId($timezone)
    {
        $timezoneId = Timezone::where('name', $timezone)->value('id');
        return $timezoneId ? : Timezone::where('name', config('app.timezone'))->value('id');
    }
}
