<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CallWidget
 *
 * @property int $id
 * @property string $domains
 * @property string $call_center_number
 * @property string $identifier
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget query()
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereCallCenterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereDomains($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallWidget whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CallWidget extends Model
{
    protected $fillable = ['domains', 'call_center_number', 'identifier'];

    public function setDomainsAttribute($value)
    {
        $value = $value ?: [];
        $this->attributes['domains'] = json_encode($value);
    }

    public function getDomainsAttribute($value)
    {
        if(!$value){
            return [];
        }
        return json_decode($value);
    }
}
