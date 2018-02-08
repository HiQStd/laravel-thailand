<?php

namespace Baraear\ThaiAddress\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Baraear\ThaiAddress\Traits\SearchableTrait as Searchable;
use Baraear\ThaiAddress\Contracts\SubDistrict as SubDistrictContract;

class SubDistrict extends Model implements SubDistrictContract
{
    use Searchable;

    /**
     * SubDistrict constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTable(config('thai_address.table_names.sub_district'));
    }

    /**
     * A sub_district must have only one district.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->BelongsTo(
            config('thai_address.models.district')
        );
    }

    /**
     * A sub_district must have only one postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postal_code(): HasOne
    {
        return $this->HasOne(
            config('thai_address.models.postal_code')
        );
    }
}
