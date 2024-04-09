<?php
// https://www.codehim.com/bootstrap/bootstrap-5-product-card-template/

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminDashboard extends Component
{

    public function render()
    {
        return view('livewire.admin.admin-dashboard')->layout('components.layouts.admin-layout');
    }


}
