<?php


namespace App\Services;


use Illuminate\Support\Facades\Log;

class MessageService
{
    public function message(string $data, int $status = 500, string $type = 'error', string $error = null)
    {
        $message = [
            'error' => 'Houve um erro na operação.',
            'warning' => 'Sem retorno para a solicitação.',
            'success' => 'Operação realizada com sucesso.',
        ];

        match ($type){
            'error' => Log::error($data,['error' => $error]),
            default => Log::info($data),
        };

        return [
            'status' => $status,
            'message' => $data,
            'error' => $error,
            'data' => $data,
            'type' => $type,
        ];
    }
}
