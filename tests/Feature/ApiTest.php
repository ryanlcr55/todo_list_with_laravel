<?php
use App\Models\User;
use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Support\Collection;

$createUserWithData = static function (int $userCount = 1, bool $createRelationData = false): Collection|User {
    $users = User::factory($userCount);

    if ($createRelationData) {
        $users = $users->has(
            Todo::factory()
                ->count(value(static fn () => random_int(5, 10)))
                ->has(TodoItem::factory()->count(value(static fn () => random_int(5, 15))), 'items')
        );
    }

    $users = $users->create();

    return ($userCount === 1) ? $users->first() : $users;
};

test('Login successful', function () use ($createUserWithData) {
    $user = $createUserWithData(createRelationData: true);

    $response = $this->post('/api/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertSuccessful();
    $this->assertAuthenticatedAs($user);
    $response->assertJsonStructure([
        'access_token'
    ]);
});


test('can refresh JWT token', function () use ($createUserWithData) {
    $user = $createUserWithData(createRelationData: true);
    auth()->guard()->login($user);
    $this->assertAuthenticated();
    $this->actingAs($user);

    $response = $this->post('/api/auth/refresh');
    $response->assertSuccessful();
    $response->assertJsonStructure([
        'access_token'
    ]);
});

test('can get user name and email', function () use ($createUserWithData) {
    $user = $createUserWithData(createRelationData: true);
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $response = $this->get('/api/auth/me');
    $response->assertSuccessful();
    $response->assertJson([
        'user' => [
            'name' => $user->name,
            'email' => $user->email,
        ]
    ]);
});

test('can get todo list', function () use ($createUserWithData) {
    $user = $createUserWithData(createRelationData: true);
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $response = $this->get('/api/todos');

    $response->assertSuccessful();
    $response->assertJsonStructure([
        'data' => [
            [
                'id',
                'user_id',
                'title',
                'attachment',
                'created_at',
                'updated_at',
                'items',
            ]
        ]
    ]);
});

test('can create and update todo', function () use ($createUserWithData) {
    $user = $createUserWithData();
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $response = $this->post('/api/todo', [
        'title' => 'My TODO list',
    ]);
    $todo = Todo::query()->where('id', $response->json('data.id'))->firstOrFail();

    $response->assertSuccessful();
    $this->assertEqualsCanonicalizing($todo->toArray(), $response->json('data'));
    $this->assertEquals('My TODO list', $response->json('data.title'));

    // Update
    $response = $this->put('/api/todo/' . $todo->id, [
        'title' => 'My TODO list (updated)',
    ]);
    $todo = Todo::query()->where('id', $response->json('data.id'))->firstOrFail();

    $response->assertSuccessful();
    $this->assertEqualsCanonicalizing($todo->toArray(), $response->json('data'));
    $this->assertEquals('My TODO list (updated)', $response->json('data.title'));
});

test('can get todo with items', function () use ($createUserWithData) {
    $user = $createUserWithData();
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $todo = Todo::factory()
        ->has(
            TodoItem::factory()->count(value(static fn () => random_int(5, 15))),
            'items'
        )
        ->create(['user_id' => $user->id]);

    $response = $this->get('/api/todo/' . $todo->id);
    $todo = Todo::query()->where('id', $response->json('id'))->with('items')->firstOrFail();

    $response->assertSuccessful();
    $this->assertEqualsCanonicalizing($todo->toArray(), $response->json());
});

test('can delete todo', function () use ($createUserWithData) {
    $user = $createUserWithData();
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $todo = Todo::factory()
        ->has(
            TodoItem::factory()->count(value(static fn () => random_int(5, 15))),
            'items'
        )
        ->create(['user_id' => $user->id])
        ->refresh()
        ->load('items');

    $response = $this->delete('/api/todo/' . $todo->id);
    $response->assertSuccessful();

    foreach ($todo->items as $item) {
        $this->assertNotTrue((bool) TodoItem::query()->find($item->id));
    }
});

test('can create and update todo items', function () use ($createUserWithData) {
    $user = $createUserWithData();
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $response = $this->post('/api/todo', [
        'title' => 'My TODO list',
    ]);
    $todo = Todo::query()->where('id', $response->json('data.id'))->firstOrFail();

    $response = $this->post('/api/todo/' . $todo->id . '/item', [
        'content' => 'First task',
    ]);
    $item = TodoItem::query()->where('id', $response->json('data.id'))->firstOrFail();

    $response->assertSuccessful();
    $this->assertEqualsCanonicalizing($item->toArray(), $response->json('data'));
    $this->assertEquals('First task', $response->json('data.content'));
});

test('can delete todo item', function () use ($createUserWithData) {
    $user = $createUserWithData();
    auth()->guard()->login($user);
    $this->assertAuthenticated();

    $response = $this->post('/api/todo', [
        'title' => 'My TODO list',
    ]);
    $todo = Todo::query()->where('id', $response->json('data.id'))->firstOrFail();

    $this->post('/api/todo/' . $todo->id . '/item', [
        'content' => 'First task',
    ]);

    $item = $todo->items->first();
    $this->delete('/api/todo/' . $todo->id . '/item/' . $item->id);

    $this->assertNotTrue((bool) TodoItem::query()->find($item->id));
});
