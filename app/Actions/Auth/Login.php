<?php

namespace App\Actions\Auth;

use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Login
{
    use AsAction;

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'string',
                'max:500',
            ],
        ];
    }

    /*
     * @return array{access_token: string}
     */
    public function handle(ActionRequest $request): array
    {
        $token = auth()->attempt($request->validated());

        abort_if(!$token, Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

        return [
            'access_token' => $token
        ];
    }
}
