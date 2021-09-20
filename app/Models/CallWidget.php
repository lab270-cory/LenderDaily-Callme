<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallWidget extends Model
{
    protected $fillable = ['domains', 'call_center_number'];

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
