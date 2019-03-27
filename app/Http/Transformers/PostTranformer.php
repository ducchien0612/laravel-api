<?php

namespace App\Http\Transformers;

use App\Repositories\Post\Post;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class PostTranformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user',
    ];

    public function transform(Post $post = null)
    {
        if (is_null($post)) {
            return [];
        }

        return [
            'id'           => $post->id,
            'title'        => $post->title,
            'user_id'      => $post->user_id,
            'content'      => $post->content,
            'created_at'   => $post->created_at ? $post->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'   => $post->updated_at ? $post->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }


    public function includeUser(Post $post = null)
    {
        if (is_null($post)) {
            return $this->null();
        }
        return $this->item($post->user, new UserTransformer());
    }
}

