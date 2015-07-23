<?php

namespace Rise\Tasks;

use \Phalcon\CLI\Task,

    \Rise\PushNotifications\Queue\Receiver;

/**
 * Class PushNotificationsTask
 * @package Rise\Tasks
 */
class PushNotificationsTask extends Task {

    public function receiverAction() {
        (new Receiver())->listen();
    }

}