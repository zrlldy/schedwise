<div class="mt-4 flex flex-col gap-6 border p-4 rounded-2xl shadow-lg  ">
  <div class="flex justify-center ">
<svg fill="#090933"  width="100px" height="100px" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" id="memory-email"><path d="M1 5H2V4H20V5H21V18H20V19H2V18H1V5M3 17H19V9H18V10H16V11H14V12H12V13H10V12H8V11H6V10H4V9H3V17M19 6H3V7H5V8H7V9H9V10H13V9H15V8H17V7H19V6Z" /></svg>
  </div>

    <flux:text class="text-center">
        {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
    </flux:text>

    @if (session('status') == 'verification-link-sent')
        <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </flux:text>
    @endif

    @error('email')
        <flux:text class="text-center font-medium text-red-500 ">
            {{ $message }}
        </flux:text>
    @enderror

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button wire:click="sendVerification" variant="primary" class="w-full">
            {{ __('Resend verification email') }}
        </flux:button>

        <flux:link class="text-sm cursor-pointer mb-3" wire:click="logout">
            {{ __('Log out') }}
        </flux:link>
    </div>
</div>
