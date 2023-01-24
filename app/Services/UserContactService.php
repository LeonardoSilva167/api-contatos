<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Http\Resources\BaseCollection;
use App\Repositories\Contracts\UserContactRepositoryInterface;
use Illuminate\Http\Request;

class UserContactService
{
    /**
     * Instancia do Repository
     *
     * @var $userContactRepository
     */
    protected $userContactRepository;

    /**
     * Construtor
     *
     * @param UserContactRepositoryInterface $userContactRepository
     */
    public function __construct(UserContactRepositoryInterface $userContactRepository)
    {
        $this->userContactRepository = $userContactRepository;
    }

    public function delete($id){
        return $this->userContactRepository->delete($id);
    }

}
