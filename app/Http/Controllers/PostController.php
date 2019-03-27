<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Transformers\PostTranformer;
use App\Repositories\Post\Post;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(PostRepositoryInterface $post)
    {
        $this->model = $post;
        $this->setTransformer(new PostTranformer());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = $this->model->getAll();
       // $post = $this->model->getAll();
        return $this->successResponse($post);
        //return PostResource::collection($post);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try
       {
           $post = $this->model->store($request->all());
           return $this->successResponse($post);
       }catch (\Exception $e)
       {

       }//return new PostResource($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $post= $this->model->getById($id);
            return $this->successResponse($post);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        }
       // return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       try
       {
           $data = $request->all();
           $post = $this->model->update($id,$data);
           return $this->successResponse($post);
       } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
           return $this->notFoundResponse();
       }
        //$data = $post->fill($request->all());
       // return new PostResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $post = $this->model->find($id);
//        $data = $post->delete($id);
//        if($data) {
//            return response()->json(['status' => true], 200);
//        }else {
//            return response()->json(['status' => false], 422);
//        }

        try {
            $this->model->delete($id);
            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
