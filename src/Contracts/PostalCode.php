<?php

namespace Baraear\ThaiAddress\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface PostalCode
{
    /**
     * A sub_district can be applied to postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_district(): BelongsTo;

    /**
     * A district can be applied to postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo;

    /**
     * A province can be applied to postal_code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo;
}
