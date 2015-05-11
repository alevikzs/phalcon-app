<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria;

/**
 * Class Collection
 * @package App\Components\Controller
 */
abstract class Collection extends Base {

    const ORDER_DIRECTION_ASC = 0;
    const ORDER_DIRECTION_DESC = 1;

    /**
     * @return array
     */
    public function getDefaultPayload() {
        return [
            'limit' => 20,
            'page' => 1,
            'order' => [
                [
                    'field' => 'name',
                    'direction' => 1
                ]
            ]
        ];
    }

    /**
     * @return integer
     */
    protected function getPage() {
        return (int) $this->getPayloadParameter('page');
    }

    /**
     * @return integer
     */
    protected function getLimit() {
        return (int) $this->getPayloadParameter('limit');
    }

    /**
     * @return array
     */
    protected function getOrder() {
        return $this->getPayloadParameter('order');
    }

    /**
     * @return integer
     */
    public function getOffset() {
        return $this->getLimit() * ($this->getPage() - 1);
    }


    /**
     * @param Criteria $query
     * @return Response
     */
    public function response(Criteria $query) {
        $count = $this->getCount($query);
        return $this->responseEmpty()
            ->setJsonContent([
                'list' => $this->buildList($query),
                'count' => $count,
                'hasNext' => $this->hasNext($count)
            ]);
    }

    /**
     * @param Criteria $query
     * @return integer
     */
    private function getCount(Criteria $query) {
        $countQuery = clone $query;
        return $countQuery
            ->execute()
            ->count();
    }

    /**
     * @param Criteria $query
     * @return array
     */
    private function buildList(Criteria $query) {
        return $query
            ->orderBy($this->buildOrder())
            ->limit($this->getLimit(), $this->getOffset())
            ->execute()
            ->toArray();
    }

    /**
     * @return string
     */
    private function buildOrder() {
        $order = [];

        $fieldsCount = count($this->getOrder());

        for ($index = 0; $index < $fieldsCount; $index++) {
            $field = $this->getPayloadParameter('order.' . $index . '.field');
            if ($field) {
                $direction = $this->getPayloadParameter('order.' . $index . '.direction');
                if ($direction) {
                    $field .= ' ' . $this->getDirection($direction);
                }
                array_push($order, $field);
            }
        }

        return implode(',', $order);
    }

    /**
     * @param integer
     * @return string
     */
    private function getDirection($direction) {
        if ($direction === 1) {
            return 'DESC';
        } else {
            return 'ASC';
        }
    }

    /**
     * @param integer $count
     * @return boolean
     */
    private function hasNext($count) {
        return $count - $this->getPage() * $this->getLimit() > 0;
    }

}