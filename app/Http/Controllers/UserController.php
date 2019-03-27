<?php

namespace App\Http\Controllers;

use App\Http\Transformers\UserTransformer;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $user)
    {
        $this->model = $user;
        $this->setTransformer(new UserTransformer());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $post = $this->model->all();
//        return $this->successResponse($post);
        //return PostResource::collection($post);

        $user = $this->model->getAll();
        return $this->successResponse($user);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $post = $this->model->create($request->all());
//        return $this->successResponse($post);
        //return new PostResource($post);

        $user = $this->model->store($request->all());
        return $this->successResponse($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $post= $this->model->find($id);
//        return new PostResource($post);

        try
        {
            $user= $this->model->getById($id);
            return $this->successResponse($user);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        }
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
//        $post = $this->model->find($id);
//        $data = $post->fill($request->all());
//         return new PostResource($data);

        try
        {
            $data = $request->all();
            $user = $this->model->update($id,$data);
            return $this->successResponse($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        }
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
