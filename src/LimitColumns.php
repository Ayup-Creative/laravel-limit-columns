<?php

namespace Ayup\LaravelLimitColumns\src;

trait LimitColumns
{
    /**
     * Boot the trait for the model.
     *
     * @return void
     */
    public static function bootLimitColumns(): void
    {
        static::addGlobalScope('limitColumns', function ($query) {
            $columns = (new static)->getFillableColumns();

            if (!empty($columns)) {
                $query->select($columns);
            }
        });
    }

    /**
     * Get fillable columns with primary key.
     *
     * @return array
     */
    private function getFillableColumns(): array
    {
        // Ensure primary key is always included
        $primaryKey = $this->getKeyName();

        // Combine primary key with fillable columns
        $columns = array_merge(
            [$primaryKey],
            $this->fillable
        );

        return array_unique($columns);
    }

    /**
     * Override method to allow dynamic column selection.
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function select(array $columns = ['*']): \Illuminate\Database\Eloquent\Builder
    {
        // If '*' is passed, use fillable columns instead
        if ($columns === ['*']) {
            $columns = $this->getFillableColumns();
        }

        return parent::select($columns);
    }
}