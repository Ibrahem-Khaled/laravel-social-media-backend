<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(CreateCommentRequest $request)
    {
        $this->authorize('create', Comment::class);

        $comment = auth()->user()->comments()->create($request->validated());

        return $this->sendResponse(
            201,
            'Comment created successfully',
        );
    }

    public function update(CreateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return $this->sendResponse(
            200,
            'Comment updated successfully',
        );
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return $this->sendResponse(
            200,
            'Comment deleted successfully',
        );
    }
}
