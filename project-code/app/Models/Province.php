<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $table = 'province';

    protected $primaryKey = 'provinceid';

    protected $casts = [
        'provinceid' => 'string',
    ];
}
