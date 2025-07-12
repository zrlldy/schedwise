<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Livewire\Attributes\Layout;
class Dashboard extends Component
{
    // #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.dashboard');
    }
}
