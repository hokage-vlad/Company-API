<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @group books
     */
    //public function testGetConnectToApi()
    //{
    //    $response = $this->get('/api/books');
//
    //    $response->assertStatus(200);
    //}

    public function testStoreStandardBook()
    {
        response()->json('POST', '/user', ['name' => 'Sally'])
            ->seeJson([
                'created' => true,
            ]);
    }
}
