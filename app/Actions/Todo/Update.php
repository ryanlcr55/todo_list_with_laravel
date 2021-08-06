<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Update
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
     * @param  int  $id
     * @return array
     */
    public function handle(ActionRequest $request, int $id)
    {
        $user = auth()->user();
        $data = $request->validated();
        $todo = Todo::query()->whereUserId($user->id)->findOrFail($id);
        $todo->update($data);

        return ['data' => Todo::find($todo->id)->toArray()];
    }
}
