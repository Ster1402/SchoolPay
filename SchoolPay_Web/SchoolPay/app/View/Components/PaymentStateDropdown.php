<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\PaymentState;

class PaymentStateDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-state-dropdown', [
            'status_arr' => PaymentState::all(),
            'currentStatus' => PaymentState::all()->first(static function(PaymentState $status){
                return $status->slug === request('status');
            })
        ]);
    }
}
