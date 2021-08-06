<?php

namespace App\Actions\Todo;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodosByUser
{
    use AsAction;

    /**
     * @return array
     */
    public function handle(): array
    {
        $user = auth()->user();
        $todos = Todo::with('items')
            ->where('user_id', '=', $user->id)
            ->orderBy('created_at')
            ->get();

        return [
            'data' => TodoResource::collection($todos),
        ];
    }
}
