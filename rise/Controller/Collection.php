<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria,

    \Rise\Models\Response\Base\Collection as CollectionResponse,
    \Rise\Http\Response\Base as HttpResponse;

/**
 * Class Collection
 * @package Rise\Controller
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
     * @return HttpResponse
     */
    public function response(Criteria $query) {
        $query = $this->buildQuery($query);

        $response = new CollectionResponse($query);

        return (new HttpResponse($response));
    }

    /**
     * @param Criteria $query
     * @return Criteria
     */
    private function buildQuery(Criteria $query) {
        return $query
            ->orderBy($this->buildOrder())
            ->limit($this->getLimit(), $this->getOffset());
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

}