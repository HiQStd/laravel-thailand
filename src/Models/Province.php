<?php

namespace Baraear\ThaiAddress\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Baraear\ThaiAddress\Traits\SearchableTrait as Searchable;
use Baraear\ThaiAddress\Contracts\Province as ProvinceContract;

class Province extends Model implements ProvinceContract
{
    use Searchable;

    /**
     * Province constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTable(config('thai_address.table_names.province'));
    }

    /**
     * A province may be given various districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts(): HasMany
    {
        return $this->HasMany(
            config('thai_address.models.district')
        );
    }

    /**
     * A province may be given various postal_codes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postal_codes(): HasMany
    {
        return $this->HasMany(
            config('thai_address.models.postal_code')
        );
    }
}
