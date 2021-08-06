<?php

namespace App\Actions\Auth;

use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetMe
{
    use AsAction;

    public function rules(): array
    {
        return [
        ];
    }

    /*
     * @return array{ user: {name: string, email: string}}
     */
    public function handle(ActionRequest $request): array
    {
        $user = json_decode(auth()->user(), true);
        abort_if(!$user, Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

        return [
            'user' => [
                'name' => $user['name'],
                'email' => $user['email'],
            ]
        ];
    }
}
