<?php

namespace App\Models;

use App\Traits\TraitHasAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, TraitHasAudit, HasFactory;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'intro',
        'type',
        'image',
        'parent_id',
        'is_active',
    ];

    protected $casts =[
        'is_active' => 'boolean',
    ];


    public function items(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Item::class, 'categoryable');
    }

    public function news(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(News::class, 'categoryable');
    }
}
