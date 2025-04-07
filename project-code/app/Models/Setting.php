<?php

namespace App\Models;

use App\Traits\TraitHasAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, TraitHasAudit;

    protected $fillable = [
        'web_name',
        'email',
        'phone',
        'address',
        'web_logo',
        'web_favicon',
        'short_desc',
        'description',
        'home_data',
        'about_us', // data page about us
    ];
}
