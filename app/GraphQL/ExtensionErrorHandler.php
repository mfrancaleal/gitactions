<?php


namespace App\GraphQL;


use Closure;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Execution\ErrorHandler;

class ExtensionErrorHandler implements ErrorHandler
{

    /**
     * @inheritDoc
     */
    public function __invoke(?Error $error, Closure $next): ?array
    {
        // TODO: Implement __invoke() method.
    }

    public static function handle(Error $error, Closure $next): array
    {
        dd($error);
        // TODO do something with $error

        return $next($error);
    }
}
