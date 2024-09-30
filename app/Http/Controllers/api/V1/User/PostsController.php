<?php


namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\CreatePostRequest;
use App\Http\Resources\API\V1\PostsResource;
use App\Http\Resources\API\V1\UserProfileResource;
use App\Jobs\PostLikedJob;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->type == 'suggestions') {
            $query->where('user_id', '!=', auth()->id())
                  ->inRandomOrder();
        } else {
            $query->whereIn('user_id', auth()->user()->followingList()->pluck('id'))
                  ->latest();
        }

        $posts = $query->active()->with('user')->paginate(10)->appends($request->query());

        return $this->sendResponse(
            200,
            'Posts fetched successfully',
            [
                'count' => $posts->count(),
                'data' => PostsResource::collection($posts->items()),
                'pagination' => [
                    'total' => $posts->total(),
                    'current_page' => $posts->currentPage(),
                    'last_page' => $posts->lastPage(),
                    'from' => $posts->firstItem(),
                    'to' => $posts->lastItem(),
                    'first_page_url' => $posts->url(1),
                    'last_page_url' => $posts->url($posts->lastPage()),
                    'next_page_url' => $posts->nextPageUrl(),
                    'prev_page_url' => $posts->previousPageUrl(),
                ],
            ]
        );
    }

    public function show($id)
    {
        $post = Post::active()->findOrFail($id);

        $post->load('user' , 'comments' , 'comments.user');
        return $this->sendResponse(
            200,
            'Post fetched successfully',
            new PostsResource($post)
        );
    }

    public function store(CreatePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = $request->user()->posts()->create(
            [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $request->hasFile('image') ? $this->uploadImage($request->image , 'posts') : null,
            ]
        );

        return $this->sendResponse(
            201,
            'Post created successfully',
            ['id' => $post->id]
        );
    }

    public function update(CreatePostRequest $request,Post $post)
    {

        $this->authorize('update', $post);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'image' => $request->hasFile('image')
                ? $this->uploadImage($request->file('image'), 'posts')
                : $post->image,
        ]);

        return $this->sendResponse(
            200,
            'Post updated successfully',
            ['id' => $post->id]
        );
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return $this->sendResponse(
            200,
            'Post deleted successfully'
        );
    }

    public function likes(Post $post)
    {
        $likes = $post->likes()->with('user')->paginate(10);

        return $this->sendResponse(
            200,
            "Likes of {$post->title} fetched successfully",
            [
                'count' => $likes->count(),
                'data' => UserProfileResource::collection($likes->pluck('user')),
                'pagination' => [
                    'total' => $likes->total(),
                    'current_page' => $likes->currentPage(),
                    'last_page' => $likes->lastPage(),
                    'from' => $likes->firstItem(),
                    'to' => $likes->lastItem(),
                    'first_page_url' => $likes->url(1),
                    'last_page_url' => $likes->url($likes->lastPage()),
                    'next_page_url' => $likes->nextPageUrl(),
                    'prev_page_url' => $likes->previousPageUrl(),
                ],
            ]
        );
    }

    public function like(Post $post)
    {
        $existingLike = $post->likes()->where('user_id', auth()->id())->exists();

        if ($existingLike) {
            return $this->sendResponse(
                400,
                'Post already liked'
            );
        }

        PostLikedJob::dispatch($post , auth()->user());


        return $this->sendResponse(
            200,
            'Post liked successfully'
        );
    }

    public function unlike(Post $post)
    {
        $existingLike = $post->likes()->where('user_id', auth()->id())->exists();

        if (!$existingLike) {
            return $this->sendResponse(
                400,
                'Post not liked yet'
            );
        }

        $post->decrement('like');
        $post->likes()->where('user_id', auth()->id())->delete();


        return $this->sendResponse(
            200,
            'Post unliked successfully'
        );
    }

}
