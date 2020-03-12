<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        
                $response->assertStatus(300);
        Cache::shouldReceive('get')
        ->with('key')
        ->andReturn('value');

        $this->visit('/cache')
                ->see('value');
        $this->assertTrue(true);
    }

    
}
