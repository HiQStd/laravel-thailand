<?php

namespace Baraear\ThaiAddress\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Baraear\ThaiAddress\Traits\SearchableTrait as Searchable;
use Baraear\ThaiAddress\Contracts\PostalCode as PostalCodeContract;

class PostalCode extends Model implements PostalCodeContract
{
    use Searchable;

    /**
     * PostalCode constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTable(config('thai_address.table_names.postal_code'));
    }

    /**
     * A sub_district can be applied to postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_district(): BelongsTo
    {
        return $this->BelongsTo(
            config('thai_address.models.sub_district')
        );
    }

    /**
     * A district can be applied to postal_code.
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
     * A province can be applied to postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->BelongsTo(
            config('thai_address.models.province')
        );
    }
}
