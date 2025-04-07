<?php

namespace App\Models;

use App\Traits\AutoGenerateItemCode;
use App\Traits\TraitHasAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Item extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, TraitHasAudit, AutoGenerateItemCode;
    use InteractsWithMedia; // lib manage file

    protected $fillable = [
        'item_code',
        'slug',
        'item_name',
        'type',
        'ward_id',
        'address',
        'short_desc',
        'description',
        'iframe_maps',
        'is_featured',
        'status',
        'area',
        'width',
        'height',
        'total_bedrooms',
        'total_bathrooms',
        'total_floors',
        'home_direction',
        'price',
        'price_text',
    ];

    protected $casts =[
        'is_featured' => 'boolean',
    ];

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'wardid');
    }

    public function registerMediaCollections(): void
    {
        // Collection cho ảnh đại diện (chỉ lưu 1 ảnh duy nhất)
        $this->addMediaCollection('featured_image')->singleFile();

        // Collection cho nhiều ảnh chi tiết
        $this->addMediaCollection('images');
    }


    // optimize image
    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('optimized')
    //         // ->fit(Manipulations::FIT_CROP, 800, 600) // Resize ảnh về 800x600
    //         ->quality(80) // Giảm chất lượng ảnh xuống 80% để tối ưu dung lượng
    //         ->format('jpg') // Chuyển sang định dạng JPG
    //         ->performOnCollections('featured_image', 'images'); // Áp dụng cho cả 2 collection
    // }
}
