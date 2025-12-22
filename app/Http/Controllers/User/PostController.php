<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Services\User\PostService;
use App\Http\Requests\User\PostStoreRequest;
use App\Http\Traits\ResponseTraits;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    protected PostService $postService;
    /**
     * Create a new AuthController instance.
     *

     * @return void
     */

    use ResponseTraits;
    public function __construct(PostService $postService)
    {
        $this->middleware('auth:user',['except'=>['index']]);
        $this->postService = $postService;
    }
    public function index(Request $request)
    {
        $conditions = $request->all();

        $posts = $this->postService->getByConditions($conditions);

        $meta = $this->postService->getPagination($posts);

        return $this->responseSuccess(Response::HTTP_OK, 'success', $posts, $meta, 'user.post.index');

        // return view('user.post.index', compact('posts', 'meta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('user.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $this->postService->store($request->validated());


        return redirect()->route('user.listpost')
            ->with('success', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        return view('user.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        $this->postService->update($request->validated(),$post);
        return redirect()->route('user.listpost')->with('success', 'success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $this->postService->destroy($post);

        return redirect()->route('user.listpost')->with('success', 'success');
    }
}
