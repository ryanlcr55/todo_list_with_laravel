<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Illuminate\Http\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Create
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
        $user = json_decode(auth()->user(), true);
        abort_if(!$user, Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

        $data = $request->validated();
        $data['user_id'] = $user['id'];
        $todo = Todo::query()->create($data);

        return ['data' => Todo::find($todo->id)->toArray()];
    }
}
