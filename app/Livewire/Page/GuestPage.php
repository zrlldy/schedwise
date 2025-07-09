<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.auth')]
class GuestPage extends Component
{
    public function render()
    {
        return view('livewire.page.guest-page');
    }
}
