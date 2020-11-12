<?php

namespace Amyisme13\LaravelJitsi\Tests;

use Amyisme13\LaravelJitsi\Http\Controllers\ViewRoomController;
use Amyisme13\LaravelJitsi\LaravelJitsiFacade;
use Firebase\JWT\JWT;

class UnitTest extends TestCase
{
    /** @test */
    function testRouteIsAvailable()
    {
        $routes = $this->app['router']->getRoutes();
        $this->assertTrue((bool) $routes->getByName('jitsi.view-room'));
        $this->assertTrue((bool) $routes->getByAction(ViewRoomController::class));
    }

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
        $user = factory(User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $token = LaravelJitsiFacade::generateJwt($user, 'hello-world');

        $decoded = JWT::decode($token, 'my-secret-key', ['HS256']);

        $this->assertEquals($decoded->iss, 'app-id');
        $this->assertEquals($decoded->aud, 'app-id');
        $this->assertEquals($decoded->sub, 'meet.jit.si');
        $this->assertEquals($decoded->room, 'hello-world');
        $this->assertObjectHasAttribute('exp', $decoded);
        $this->assertObjectHasAttribute('user', $decoded);

        $this->assertEquals($decoded->user->id, $user->id);
        $this->assertEquals($decoded->user->name, 'Jane Doe');
        $this->assertEquals($decoded->user->email, 'jane@example.com');
        // Shouldnt exists when null
        $this->assertObjectNotHasAttribute('avatar', $decoded->user);
    }

    /** @test */
    public function testJitsiAttributesCanBeOverriden()
    {
        $user = factory(UserOverride::class)->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $token = LaravelJitsiFacade::generateJwt($user, 'hello-world');

        $decoded = JWT::decode($token, 'my-secret-key', ['HS256']);

        $this->assertEquals($decoded->user->name, 'fake name');
        $this->assertEquals($decoded->user->email, 'fake-email@example.com');
        $this->assertEquals($decoded->user->avatar, 'https://picsum.photos/100');
    }
}
