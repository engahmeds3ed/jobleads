<?php

namespace App\Services;

use App\Entities\User;
use App\Helpers\DataHelper;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function all(array $params)
    {
        $perPage = $params['per_page'] ?? 10;
        $paginate = $params['paginate'] ?? true;
        $filters = $params['filters'] ?? [];

        $query = $this->users;

        if(!empty($filters)) {
            $query = $query->filter($filters);
        }

        if($paginate == true) {
            $collection = $query->paginate($perPage);
        }else{
            $collection = $query->get();
        }

        return $collection;
    }

    public function find(int $id):User
    {
        $item = $this->users->find($id);
        return $item;
    }

    /**
     * Create new User
     * @param  array  $attributes
     * @return App\Entities\User
     */
    public function create(array $attributes):User
    {
        $item = new User();

        $allowedAttr = $item->getFillable();
        $createArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            $createArgs['password'] = bcrypt($createArgs['password']);
            $item = $this->users->create($createArgs);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $item;
    }

    /**
     * Update User
     * @param  array  $attributes
     * @return App\Entities\User
     */
    public function update(array $attributes, int $id):User
    {
        $item = $this->find($id);

        $allowedAttr = $item->getFillable();
        $updateArgs = DataHelper::filterArrayWithKeys($attributes, $allowedAttr);
        try {
            if(isset($updateArgs['password']) && !empty($updateArgs['password'])){
                $updateArgs['password'] = bcrypt($updateArgs['password']);
            }else{
                unset($updateArgs['password']);
            }

            $item = $this->users->update($updateArgs, $item->id);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $item;
    }

    public function delete(int $id):bool
    {
        $item = $this->find($id);
        return $this->users->delete($item->id);
    }

    public function getUserBy($field, $value){
        return $this->users->findByField($field, $value);
    }

    public function getUserByEmail(string $email){
        return $this->getUserBy('email', $email);
    }

}
