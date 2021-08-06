<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodoWithItem
{
    use AsAction;

    public function rules(): array
    {
        return [
        ];
    }



    public function handle($todoId): array
    {
        return Todo::with('items')
            ->findOrFail($todoId)
            ->toArray();
    }
}
