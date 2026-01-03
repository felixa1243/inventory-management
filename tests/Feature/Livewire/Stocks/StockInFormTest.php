<?php

namespace Tests\Feature\Livewire\Stocks;

use App\Livewire\Stocks\StockInForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StockInFormTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(StockInForm::class)
            ->assertStatus(200);
    }
}
