<?php


namespace App\GraphQL\Mutations;


use App\Exceptions\LoginException;
use GraphQL\Error\Error;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;

class AuthMutator
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function login($root, array $args): Array
    {
        $credentials = Arr::only($args, ['email', 'password', 'type_user']);
        $guard = Auth::guard(config('sanctum.guard', 'web'));

        if(!$guard->attempt($credentials)) {
            return ["status" => 401, "message" => 'Invalid Credentials', 'token' => ''];
        }
        else {
            /**
             * @var \App\Models\User $user
             */
            try{
                $token = $guard->user()->createToken($args['type_user'])->plainTextToken;
            } catch (\Exception | \Throwable $e) {
                return ["status" => 500, "message" => $e->getMessage(), 'token' => ''];
            }
            Log::info('Login User');
        }
        return ["status" => 200, 'message' => 'Login realizado com sucesso', 'token' => $token];
    }

    public function logout()
    {

    }
}
