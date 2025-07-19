<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Livewire\Attributes\Layout;
class GuestPage extends Component
{
    #[Layout("components.layouts.app")]
    public function render()
    {
        return view('livewire.page.guest-page');
    }
}
