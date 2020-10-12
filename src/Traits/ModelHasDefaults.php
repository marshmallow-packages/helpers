<?php

namespace Marshmallow\HelperFunctions\Traits;

trait ModelHasDefaults
{
    /**
     * Addind default attributes on __construct level is
     * needed for Nova so it pre-filles the form fields
     * when creating a new resource record.
     * @param array $params [description]
     */
    public function __construct($params = [])
    {
        $default_attributes = $this->defaultAttributes();
        foreach ($default_attributes as $column => $default_value) {
            if (! isset($params[$column])) {
                $params[$column] = $default_value;
            }
        }

        parent::__construct($params);
    }

    /**
     * This is called when your are saving a model resource.
     * @return [type] [description]
     */
    public function applyDefaultAttributes()
    {
        $default_attributes = $this->defaultAttributes();
        foreach ($default_attributes as $column => $default_value) {
            if (! $this->$column) {
                $this->$column = $default_value;
            }
        }
    }

    abstract protected function defaultAttributes(): array;

    /**
     * To handle default we need an observer. We use our own
     * Marshmallow Observer so we don't need to register them
     * for every project. This is now down automaticly.
     * @return [type] [description]
     */
    abstract public static function getObserver(): string;

    abstract public static function bootObserver(): void;
}
