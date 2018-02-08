<?php

namespace Baraear\ThaiAddress\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface District
{
    /**
     * A district may be given various sub_districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_districts(): HasMany;

    /**
     * A district must have only one province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo;

    /**
     * A district may be given various postal_codes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postal_codes(): HasMany;
}
