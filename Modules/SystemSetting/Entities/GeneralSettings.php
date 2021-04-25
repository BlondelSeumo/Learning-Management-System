<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Localization\Entities\Language;
use Rennokki\QueryCache\Traits\QueryCacheable;

class GeneralSettings extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];
    protected $table = 'general_settings';

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withDefault();
    }

    public function timezone()
    {
        return $this->belongsTo(TimeZone::class, 'timezone_id')->withDefault();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }
}
