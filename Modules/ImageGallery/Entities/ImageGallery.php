<?php

namespace Modules\ImageGallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ImageGallery extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'image_galleries';
    protected $fillable = ['title','image','description','status'];
}
