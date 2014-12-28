<?php

namespace UAW\Bundle\RestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemControllerTest extends WebTestCase
{
    public function testGetItems()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/items');
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue(strpos($response->getContent(), '"id":1') !== false);
    }

    public function testGetItem()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/items/1');
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue(strpos($response->getContent(), '"id":1') !== false);
    }
}
