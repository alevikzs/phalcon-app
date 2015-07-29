<?php

namespace Rise\Tests\Api;

use \Rise\ApiTestCase;

/**
 * Class NotFoundTest
 * @package Rise\Tests\Api
 */
class NotFoundTest extends ApiTestCase {

    /**
     * @return void
     */
    protected function saveStub() {}

    /**
     * @return void
     */
    protected function clearStub() {}

    /**
     * @return array
     */
    protected function createStub() {}

    public function testMain() {
        $response = $this->post('/not-found', []);
        $responsePayload = $response->json();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'Not Found');
        $this->assertEquals($responsePayload['data']['code'], 404);
    }

}