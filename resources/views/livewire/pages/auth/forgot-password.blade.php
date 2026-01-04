<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    $status = Password::sendResetLink($this->only('email'));

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));
        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
};

?>

<div>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reset Password</h2>
    </div>

    <div class="mb-6 text-sm text-center text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-between gap-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white underline"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Back to Login') }}
            </a>

            <x-primary-button>
                {{ __('Email Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div>
