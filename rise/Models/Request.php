<?php

namespace Rise\Models;

use \stdClass;

/**
 * Class Request
 * @package Rise\Models
 */
abstract class Request {

    const RELATION_ONE = 'one';

    const RELATION_MANY = 'many';

    /**
     * @param stdClass $payload
     * @return self
     */
    public static function cast(stdClass $payload) {
        $instance = new static();

        $fields = get_class_vars(static::class);

        foreach ($payload as $field => $value) {
            if (array_key_exists($field, $fields)) {
                if($instance->isRelationMany($field, $value)) {
                    $instance->$field = $instance->createRelationMany($field, $value);
                } elseif($instance->isRelationOne($field, $value)) {
                    $instance->$field = $instance->createRelationMany($field, $value);
                } else {
                    $instance->$field = $value;
                }
            }
        }

        return $instance;
    }

    /**
     * @return array
     */
    public function relations() {
        return [];
    }

    /**
     * @param string $field
     * @param stdClass $payload
     * @return bool
     */
    private function isRelationOne($field, stdClass $payload) {
        if ($this->isRelation($field)
            && !is_array($payload->$field)
            && $this->relations()[$field]['type'] === self::RELATION_ONE
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param string $field
     * @param stdClass $payload
     * @return bool
     */
    private function isRelationMany($field, stdClass $payload) {
        if ($this->isRelation($field)
            && is_array($payload->$field)
            && $this->relations()[$field]['type'] === self::RELATION_MANY
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param string $field
     * @return bool
     */
    private function isRelation($field) {
        if ($this->relations()
            && array_key_exists($field, $this->relations())
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $field
     * @param stdClass $payload
     * @return Request
     */
    private function createRelationOne($field, stdClass $payload) {
        /** @var self $model */
        $model = $this->relations()[$field]['model'];

        return $model::cast($payload);
    }

    /**
     * @param $field
     * @param stdClass $payload
     * @return Request[]
     */
    private function createRelationMany($field, stdClass $payload) {
        foreach ($payload as $instance) {
            yield $this->createRelationOne($field, $instance);
        }
    }

}