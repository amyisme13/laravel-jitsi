<?php

namespace Amyisme13\LaravelJitsi\Tests;

use Amyisme13\LaravelJitsi\LaravelJitsiFacade;

class UnitTest extends TestCase
{
    /** @test */
    public function testViewRoomWithoutParameter()
    {
        $view = LaravelJitsiFacade::viewRoom();
        $data = $view->getData();

        $this->assertArrayHasKey('room', $data);
        $this->assertArrayHasKey('jwt', $data);

        $this->assertNotNull($data['room']);
        $this->assertNull($data['jwt']);
    }

    /** @test */
    public function testViewRoomWithRoomParameter()
    {
        $view = LaravelJitsiFacade::viewRoom('hello-world');
        $data = $view->getData();

        $this->assertEquals('hello-world', $data['room']);
        $this->assertNull($data['jwt']);
    }

    /** @test */
    public function testViewRoomWithRoomAndUserParameter()
    {
        $user = factory(User::class)->create();

        $view = LaravelJitsiFacade::viewRoom('hello-world', $user);
        $data = $view->getData();

        $this->assertEquals('hello-world', $data['room']);
        $this->assertNotNull($data['jwt']);
    }

    /** @test */
    public function testGenerateJwtContent()
    {
        // TODO
        $this->assertTrue(true);
    }
}
