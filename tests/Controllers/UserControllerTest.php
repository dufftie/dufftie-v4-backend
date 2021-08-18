<?php
namespace Controllers;

use App\Models\User;
use Database\Factories\UserFactory;
use TestCase;
use Laravel\Lumen\Application;

class UserControllerTest extends TestCase
{
    public function testUserFoundReturnsUserAttributes()
    {
        $uf = UserFactory::new();
        /**
         * @var User $user
         */
        $user = $uf->make();
        $user->save();

        $this->get('user/' . $user->username, []);
        $this->seeStatusCode(200);
        $this->seeJson(
            [
                "username" => $user->username,
                "name" => $user->name,
                "surname" => $user->surname,
                "sex" => $user->sex,
                "email" => $user->email,
                "profileImage" => $user->profileImage,
                "description" => $user->description,
                "location" => $user->location,
            ],
        );
    }

    public function testUserNotFoundReturns404()
    {
        $this->get('user/userdoesntexist');
        $this->seeStatusCode(404);
    }

    public function createApplication(): Application
    {
        return parent::createApplication();
    }
}
