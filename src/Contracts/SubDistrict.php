<?php

namespace Baraear\ThaiAddress\Contracts;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface SubDistrict
{
    /**
     * A sub_district must have only one district.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo;

    /**
     * A sub_district must have only one postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postal_code(): HasOne;
}
