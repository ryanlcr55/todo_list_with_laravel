<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTodo
{
    use AsAction;

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string'
            ],
            'attachment' => [
                'string',
            ],
        ];
    }

    /**
     * @param  ActionRequest  $request
     * @return array
     */
    public function handle(ActionRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        $todo = Todo::query()->create($data);

        return ['data' => Todo::find($todo->id)->toArray()];
    }
}
