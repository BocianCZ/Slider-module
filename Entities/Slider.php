<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property string $caption
 * @property string $uri
 * @property string $url
 * @property string $custom_html
 * @property Collection<Slide> $slides
 * @property Collection<Slide> $activeSlides
 * @property bool $active
 */
class Slider extends Model
{
    protected $fillable = [
        'name',
        'system_name',
        'active',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    protected $table = 'slider__sliders';

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class)
            ->orderBy('position', 'asc');
    }

    /**
     * @return Collection<Slide>
     */
    public function getActiveSlidesAttribute(): Collection
    {
        return $this->slides
            ->where('active', '=', true)
            ->values();
    }
}
