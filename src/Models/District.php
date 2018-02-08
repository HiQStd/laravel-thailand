<?php

namespace Baraear\ThaiAddress\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Baraear\ThaiAddress\Traits\SearchableTrait as Searchable;
use Baraear\ThaiAddress\Contracts\District as DistrictContract;

class District extends Model implements DistrictContract
{
    use Searchable;

    /**
     * District constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTable(config('thai_address.table_names.district'));
    }

    /**
     * A district may be given various sub_districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_districts(): HasMany
    {
        return $this->HasMany(
            config('thai_address.models.sub_district')
        );
    }

    /**
     * A district must have only one province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->BelongsTo(
            config('thai_address.models.province')
        );
    }

    /**
     * A district may be given various postal_codes.
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
