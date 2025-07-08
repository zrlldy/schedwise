<x-mail::message>
    # Hello, Admin

    A new user has registered:

    Name: {{ $user->name }}

    <x-mail::button :url="$verificationUrl">
        Verify
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
