<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/26/2019
 * Time: 9:11 AM
 */

namespace App\Repositories\Post;


use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
//        $test = new Post();
//        dd($test);
        $this->model = $post;
    }



}
