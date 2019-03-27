<?php
/**
 * Created by PhpStorm.
 * User: DUCCHIEN-PC
 * Date: 3/23/2019
 * Time: 1:04 AM
 */

namespace App\Repositories\Post;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'user_id','title','content'
        ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
