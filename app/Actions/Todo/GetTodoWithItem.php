<?php

namespace App\Actions\Todo;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodoWithItem
{
    use AsAction;

    /**
     * @param  int  $todoId
     * @return string
     */
    public function handle(int $todoId)
    {
        $todo = Todo::with('items')
            ->findOrFail($todoId);
        return TodoResource::make($todo)->toJson();
    }
}
