<?php

namespace App\Http\Services\User;

use App\Repositories\Contracts\User\PostRepositoryInterface;

use App\Http\Services\BaseService;

class PostService extends BaseService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
