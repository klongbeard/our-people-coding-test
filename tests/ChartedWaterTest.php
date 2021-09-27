<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use AlbertCht\Lumen\Testing\TestCase as TestCase;


class ChartedWaterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function createApplication()
    {
        // return require $this->getAppPath();
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function testIndex()
    {
        $this->json('GET', '/api/v1/all')
            ->assertJson(['code' => 200, 'error' => false]);
    }

    use DatabaseTransactions;
    public function testCreate()
    {
        $response = $this->json('GET', '/api/v1/create');
        $response->assertJson(['code' => 200, 'error' => false]);
        $response->assertJsonCount(5, 'map.*');

        $response = $this->json('GET', '/api/v1/create?islandSize=10');
        $response->assertJson(['code' => 200, 'error' => false]);
        $response->assertJsonCount(10, 'map.*');
    }
}
