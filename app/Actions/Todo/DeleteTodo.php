<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTodo
{
    use AsAction;

    /**
     * @param $todoId
     */
    public function handle($todoId)
    {
        $user = auth()->user();
        $todo = Todo::query()->whereUserId($user->id)->findOrFail($todoId);
        $todo->items()->delete();
        $todo->delete();
    }
}
