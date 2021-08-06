<?php

namespace App\Actions\Todo;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTodo
{
    use AsAction;

    public function rules(): array
    {
        return [
            'title' => [
                'string'
            ],
            'attachment' => [
                'string',
            ],
        ];
    }

    /**
     * @param  ActionRequest  $request
     * @param  int  $todoId
     * @return array
     */
    public function handle(ActionRequest $request, int $todoId)
    {
        $user = auth()->user();
        $data = $request->validated();
        $todo = Todo::query()->whereUserId($user->id)->findOrFail($todoId);
        $todo->update($data);

        return ['data' => TodoResource::make(Todo::find($todo->id))];
    }
}
