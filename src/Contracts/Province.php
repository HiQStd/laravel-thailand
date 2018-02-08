<?php

namespace Baraear\ThaiAddress\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Province
{
    /**
     * A province may be given various districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts(): HasMany;

    /**
     * A province may be given various postal_codes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postal_codes(): HasMany;
}
