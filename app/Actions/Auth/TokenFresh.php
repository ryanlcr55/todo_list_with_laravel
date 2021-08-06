<?php

namespace App\Actions\Auth;

use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class TokenFresh
{
    use AsAction;

    public function rules(): array
    {
        return [
        ];
    }

    /*
     * @return array{access_token: string}
     */
    public function handle(ActionRequest $request): array
    {
        $token = auth()->refresh();
        abort_if(!$token, Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

        return [
            'access_token' => $token
        ];
    }
}
