<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetByUser
{
    use AsAction;

    public function rules(): array
    {
        return [
        ];
    }


    /**
     * @param  ActionRequest  $request
     * @return array
     */
    public function handle(ActionRequest $request): array
    {
        $user = json_decode(auth()->user(), true);
        abort_if(!$user, Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

        $todos = Todo::with('items')
            ->where('user_id', '=', $user['id'])
            ->orderBy('created_at')
            ->get();

        return [
            'data' => $todos,
        ];
    }
}
