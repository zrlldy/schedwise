    <div class="flex flex-row gap-5    ">

        <div class=" flex justify-center">
            <div class="border p-8 rounded-2xl  max-w-md bg-white dark:bg-gray-800 shadow-md w-screen">
                <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <!-- Form -->
                <form wire:submit="register" class="flex flex-col gap-6 mt-4">
                    <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus
                        autocomplete="name" :placeholder="__('Full name')" />

                    <flux:input wire:model="email" :label="__('Email address')" type="email" required
                        autocomplete="email" placeholder="email@example.com" />

                    <div class="flex gap-4">
                        <flux:input wire:model="password" :label="__('Password')" type="password" required
                            autocomplete="new-password" :placeholder="__('Password')" viewable />
                        <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password"
                            required autocomplete="new-password" :placeholder="__('Confirm password')" viewable />
                    </div>

                    <div class="flex items-center justify-end">
                        <flux:button type="submit" variant="primary" class="w-full">
                            {{ __('Create account') }}
                        </flux:button>
                    </div>
                </form>
                <!-- Footer Link -->
                <div class="text-center mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Already have an account?') }}</span>
                    <flux:link :href="route('login')" wire:navigate>
                        {{ __('Log in') }}
                    </flux:link>
                </div>

            </div>
        </div>
