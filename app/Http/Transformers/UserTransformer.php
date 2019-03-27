<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/26/2019
 * Time: 5:27 AM
 */

namespace App\Http\Transformers;


use App\User;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;
class UserTransformer extends  TransformerAbstract
{
    protected $availableIncludes = [
        'post',
    ];

    public function transform(User $user = null)
    {
        if (is_null($user)) {
            return [];
        }

        return [
            'id'           => $user->id,
            'name'         => $user->name,
            'email'        => $user->email,
            'created_at'   => $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'   => $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }


    public function includePost(User $user = null)
    {
        if (is_null($user)) {
            return $this->null();
        }
        return $this->collection($user->post, new PostTranformer());
    }

}
