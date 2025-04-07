<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'ward';

    protected $primaryKey = 'wardid';

    public function district()
    {
        return $this->belongsTo(District::class, 'districtid');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'ward_id', 'id');
    }

    protected $casts = [
        'wardid' => 'string'
    ];
}
