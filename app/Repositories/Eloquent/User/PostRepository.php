<?php

namespace App\Repositories\Eloquent\User;

use App\Models\Post;
use App\Repositories\Contracts\User\PostRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
    * Create a new class instance.
    */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
