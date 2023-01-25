<?php

namespace App\Services;

use App\Exceptions\Message;
use App\Http\Resources\BaseCollection;
use App\Repositories\Contracts\AdditionalContactRepositoryInterface;
use Illuminate\Http\Request;

class AdditionalContactService
{
    /**
     * Instancia do Repository
     *
     * @var $additionalContactRepository
     */
    protected $additionalContactRepository;

    /**
     * Construtor
     *
     * @param AdditionalContactRepositoryInterface $additionalContactRepository
     */
    public function __construct(AdditionalContactRepositoryInterface $additionalContactRepository)
    {
        $this->additionalContactRepository = $additionalContactRepository;
    }

    public function delete($id){
        return $this->additionalContactRepository->delete($id);
    }

}
