<?php

namespace App\Actions\Todo\Item;

use App\Models\Todo;
use App\Models\TodoItem;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\TodoItemResource;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOrUpdateItem
{
    use AsAction;

    public function rules(): array
    {
        return [
            'content' => [
                'required',
                'string',
                'max:255'
            ],
            'done_at' => [
                'date',
            ],
        ];
    }

    public function handle(ActionRequest $request, int $todoId, ?int $itemId = null)
    {
        $user = auth()->user();

        $todo = Todo::query()->whereUserId($user->id)->findOrFail($todoId);

        if ($itemId) {
            return TodoItemResource::make(
                tap(
                    TodoItem::query()->findOrFail($itemId),
                    static fn (TodoItem $todoItem) => $todoItem->update($request->validated())
                )
            );
        }

        $todoData = array_merge($request->validated(), [
            'todo_id' => $todo->id
        ]);

        return TodoItemResource::make(TodoItem::query()->create($todoData));
    }
}
