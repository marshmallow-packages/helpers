<?php

namespace Marshmallow\HelperFunctions\Observers;

class ModelObserver
{
    public function saving($model)
    {
        if (method_exists($model, 'applyDefaultAttributes')) {
            $model->applyDefaultAttributes();
        }
        if (method_exists($model, '__saving')) {
            $model->__saving();
        }
    }

    public static function observe($class_name)
    {
        /**
         * Register the observer through the model's static event methods
         * instead of Model::observe(). As of Laravel 13 Model::observe()
         * instantiates the model (new static), which throws a LogicException
         * when called while the model is still booting — and this method runs
         * from the Observer trait's bootObserver() during boot. The static
         * event registrars attach a listener without booting the model.
         */
        $events = [
            'retrieved', 'creating', 'created', 'updating', 'updated',
            'saving', 'saved', 'deleting', 'deleted', 'restoring', 'restored',
            'trashed', 'forceDeleting', 'forceDeleted', 'replicating',
        ];

        foreach ($events as $event) {
            if (method_exists(static::class, $event)) {
                $class_name::{$event}(static::class . '@' . $event);
            }
        }
    }
}
