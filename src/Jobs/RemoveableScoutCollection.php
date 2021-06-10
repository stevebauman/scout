<?php

namespace Laravel\Scout\Jobs;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Collection;

class RemoveableScoutCollection extends Collection
{
    /**
     * Get the Scout identifiers for all of the entities.
     *
     * @return array
     */
    public function getQueueableIds()
    {
        if ($this->isEmpty()) {
            return [];
        }

        return in_array(Searchable::class, class_uses_recursive($this->first()))
                    ? $this->map->getScoutKey()->all()
                    : parent::getQueueableIds();
    }
}
