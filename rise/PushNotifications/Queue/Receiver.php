<?php

namespace Rise\PushNotifications\Queue;

use \Rise\PushNotifications\Queue;

/**
 * Class Receiver
 * @package Rise\PushNotifications\Queue
 */
class Receiver extends Queue {

    /**
     * @return $this
     */
    public function listen() {
        $this->consume();

        while(count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }

        $this->close();

        return $this;
    }

    /**
     * @return $this
     */
    private function consume() {
        $this
            ->getChannel()
            ->basic_consume(
                $this->getQueue(),
                '',
                false,
                true,
                false,
                false,
                [
                    $this, 'handler'
                ]
            );

        return $this;
    }

    /**
     * @param $message
     */
    private function handler($message) {

    }

}