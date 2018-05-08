<?php

namespace EFrame\Uuid;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * This function overwrites the default boot static method of Eloquent models. It will hook
     * the creation event with a simple closure to insert the UUID
     */
    public static function bootHasUuid()
    {
        static::creating(function ($model) {

            if (!isset($model->attributes[$model->getKeyName()])) {
                $model->incrementing = false;
                $model->attributes[$model->getKeyName()] = Uuid::uuid4()->toString();
            }
        }, 0);
    }
}