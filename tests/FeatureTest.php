<?php

namespace Amyisme13\LaravelJitsi\Tests;

class FeatureTest extends TestCase
{
    /** @test */
    public function testViewRoomWithoutRoomParameterAndUnauthenticated()
    {
        $this
            ->get('/jitsi')
            ->assertSuccessful()
            ->assertDontSee('options.jwt =');
    }

    /** @test */
    public function testViewRoomWithRoomParameterAndUnauthenticated()
    {
        $this
            ->get('/jitsi/hello-world')
            ->assertSuccessful()
            ->assertSee('roomName: "hello-world"')
            ->assertDontSee('options.jwt =');
    }

    /** @test */
    public function testViewRoomWithoutRoomParameterAndAuthenticated()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this
            ->get('/jitsi')
            ->assertSuccessful()
            ->assertSee('options.jwt =');
    }

    /** @test */
    public function testViewRoomWithRoomParameterAndAuthenticated()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this
            ->get('/jitsi/hello-world')
            ->assertSuccessful()
            ->assertSee('roomName: "hello-world"')
            ->assertSee('options.jwt =');
    }
}
