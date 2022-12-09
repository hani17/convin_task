<?php

namespace Tests\Feature\Http\Requests;

use App\Http\Requests\StoreTaskRequest;
use App\Rules\MustBeAdminRule;
use App\Rules\MustBeOrdinaryUserRule;
use Tests\TestCase;

class TaskRequestTest extends TestCase
{

    /** @test */
    public function it_has_the_correct_store_rules()
    {
        $request = new StoreTaskRequest;

        $rules = [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id', new MustBeOrdinaryUserRule],
            'assigned_by_id' => ['required', 'integer', 'exists:users,id', new MustBeAdminRule]
        ];

        $this->assertEquals($rules, $request->rules());
    }
}
