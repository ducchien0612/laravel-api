<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/26/2019
 * Time: 9:14 AM
 */

namespace App\Repositories\User;


use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;

    }

}
