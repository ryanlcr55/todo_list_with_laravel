<?php

namespace App\Actions\Auth;

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
        $user = auth()->user();

        return [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ];
    }
}
