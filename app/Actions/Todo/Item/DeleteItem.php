<?php

namespace App\Actions\Todo\Item;

use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteItem
{
    use AsAction;

    /**
     * @param $todoId
     */
    public function handle($todoId, $itemId)
    {
        $todo = Todo::with('items')
            ->findOrFail($todoId);

        $todo->items()->where('id', '=', $itemId)
            ->firstOrFail()
            ->delete();
    }
}
