<?php

namespace Tests\Feature\Livewire\Stocks;

use App\Livewire\Stocks\StockOutForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StockOutFormTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(StockOutForm::class)
            ->assertStatus(200);
    }
}
