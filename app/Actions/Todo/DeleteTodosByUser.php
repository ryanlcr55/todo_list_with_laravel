<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTodosByUser
{
    use AsAction;

    /**
     * @param $todoId
     */
    public function handle()
    {
        $user = auth()->user();
        $todos = Todo::query()->whereUserId($user->id)->get();
        foreach ($todos as $todo) {
            $todo->items()->delete();
            $todo->delete();
        }
    }
}
