<?php


namespace App\Exceptions;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;
use Exception;

class CustomException extends Exception implements RendersErrorsExtensions
{

    /**
     * @var @string
     */
    protected $reason;
    protected $category;
    protected $status;

//    public function __construct(string $message, string $reason = '', string $category, int $status)
//    {
//        parent::__construct($message);
//        Log::error($message,['local' => 'local']);
//        $this->reason = $reason;
//        $this->category = $category;
//        $this->status = $status;
//    }

    public function __invoke($mensagem)
    {
        dd($mensagem);
    }

    /**
     * @inheritDoc
     */
    public function isClientSafe()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @inheritDoc
     */
    public function extensionsContent(): array
    {
        return [
            //'some' => 'additional information',
            'reason' => $this->reason,
            'status' => $this->status,
        ];
    }
}
