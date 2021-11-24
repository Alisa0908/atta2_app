<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'feature',
        'lost_desc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

    public function getImagePathAttribute()
    {
        return 'items/' . $this->attachment->name;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function scopeSearch(Builder $query, $params)
    {
        //リレーション時のwhreHas構文
        if (!empty($params['category'])) {
            $query->whereHas('category', function ($q) use ($params) {
                $q->where('category_id', $params['category']);
            });
        }
        if (!empty($params['lost_desc'])) {
            // $query->where('lost_desc', $params['lost_desc']);
            $query->where('lost_desc', '>=', $params['lost_desc']);
        }
        if (!empty($params['feature'])) {
            $query->where('feature', $params['feature']);
        }
        return $query;
    }

    // public function scopeOrder(Builder $query, $params)
    // {
    //     if ((empty($params['sort'])) ||
    //         (!empty($params['sort']) && $params['sort'] == PlaceConst::SORT_NEW_ARRIVALS)
    //     ) {
    //         $query->latest();
    //     } elseif (!empty($params['sort']) && $params['sort'] == PlaceConst::SORT_OLD_ARRIVALS) {
    //         $query->oldest();
    //     } elseif (!empty($params['sort']) && $params['sort'] == PlaceConst::SORT_CATEGORY_NUMBER) {
    //         $query->orderBy('category_id', 'asc');
    //     }

    //     return $query;
    // }
}
