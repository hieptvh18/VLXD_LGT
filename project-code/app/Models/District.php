<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $table = 'district';

    protected $primaryKey = 'districtid';

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinceid');
    }

    protected $casts = [
        'districtid' => 'string',
    ];
}
