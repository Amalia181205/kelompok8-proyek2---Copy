<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Scope untuk gallery aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk sorting
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Accessor untuk URL gambar
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    // Mutator untuk kategori
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = strtolower($value);
    }

    // Accessor untuk kategori (format judul)
    public function getCategoryFormattedAttribute()
    {
        return ucfirst($this->category);
    }
}