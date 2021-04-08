<?php

namespace Tests;

use App\Models\Role;
use App\Models\Timezone;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    /**
     * Currently logged in user
     *
     * @var User
     */
    public $user;

    /**
     * creates user and logs it in
     *
     * @param string $role
     * @return User
     */
    protected function getLoggedInUserForWeb($role) : User
    {
        $this->user = $this->createUser($role);
        $this->be($this->user);
        return $this->user;
    }

    /**
     * creates user
     *
     * @param string $role
     * @return User
     */
    protected function createUser($role) : User
    {
        $roleId = Role::getRoleId($role);
        $roleId = $roleId ?? Role::getDefaultRoleId();
        return User::factory(['role_id' => $roleId, 'timezone_id'=> Timezone::getTimezoneId('UTC')])->create();
    }
}
