<?php

namespace App\Models;

use App\Traits\TraitHasAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class News.
 *
 * @package namespace App\Models;
 */
class News extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, TraitHasAudit;
    use InteractsWithMedia; // lib manage file

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'short_desc',
        'content',
        'source', // ghi nguon
        'is_featured',
        'status',
        'is_first_page',
        'views',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_first_page' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    // register upload media lib
    public function registerMediaCollections(): void
    {
        // Collection cho ảnh đại diện (chỉ lưu 1 ảnh duy nhất)
        $this->addMediaCollection('featured_image')->singleFile();
    }
}
