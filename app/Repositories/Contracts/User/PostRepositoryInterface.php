<?php


namespace App\Repositories\Contracts\User;

interface PostRepositoryInterface
{
    public function all($conditions = []);
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
