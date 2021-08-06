<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodoByUser
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
        $user = auth()->user();

        $todos = Todo::with('items')
            ->where('user_id', '=', $user->id)
            ->orderBy('created_at')
            ->get();

        return [
            'data' => $todos,
        ];
    }
}
