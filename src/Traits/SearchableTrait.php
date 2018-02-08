<?php

namespace Baraear\ThaiAddress\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

trait SearchableTrait
{
    /**
     * Scope a query to searchable.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $keyword
     * @param null|string|array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $builder, $keyword, $filters = null)
    {
        $fields = [];
        switch ($filters) {
            case null:
                $fields = $this->fillable;
                break;
            case is_string($filters):
                if ($filters == '*') {
                    $fields = Schema::getColumnListing($this->table);
                } else {
                    array_push($fields, $filters);
                }
                break;
            case is_array($filters):
                $fields = $filters;
                break;
            default:
                $fields = $this->fillable;
        }
        if (! empty($keyword) || ! is_null($keyword)) {
            $builder->where(function ($builder) use ($keyword, $fields) {
                foreach ($fields as $key => $field) {
                    if ($key == 0) {
                        $builder->where($field, 'LIKE', "%$keyword%");
                    } else {
                        $builder->orWhere($field, 'LIKE', "%$keyword%");
                    }
                }
            });
        }

        return $builder;
    }
}
