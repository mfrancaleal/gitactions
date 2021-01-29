<?php

namespace App\Services;

use App\Repositories\AuthorRepositoryInterface;

class AuthorService
{
    public function __construct(
        private AuthorRepositoryInterface $AuthorRepository,
        private MessageService $messageService
    ){}

    public function delete(int $id): array
    {
        try {
            $this->AuthorRepository->delete($id);
        } catch (\Exception | \Throwable $e) {
            return $this->messageService->message(data: 'NÃO FOI POSSÍVEL EXCLUIR. TENTE NOVAMENTE.', error: $e->getMessage());
        }
        return $this->messageService->message(data: 'AUTHOR EXCLUÍDO COM SUCESSO', status: 200, type: 'success');
    }

    public function create(array $attributes): array
    {
        try {
            $this->AuthorRepository->store($attributes);
        } catch (\Exception | \Throwable $e) {
            return $this->messageService->message(data: 'ERRO AO CADASTRAR AUTOR',error: $e->getMessage());
        }
        return $this->messageService->message(data: 'AUTHOR CADASTRADO COM SUCESSO', status: 200, type: 'success');
    }

    public function update(array $attributes, int $id): array
    {
        try {
            $this->AuthorRepository->update($attributes, $id);
        } catch (\Exception | \Throwable $e) {
            return $this->messageService->message('NÃO FOI POSSÍVEL ALTERAR O AUTOR. TENTE NOVAMENTE', error: $e->getMessage());
        }
        return $this->messageService->message(data: 'AUTOR ALTERADO COM SUCESSO', status: 200, type: 'success');
    }

}
