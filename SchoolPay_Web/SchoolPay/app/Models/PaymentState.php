<?php

namespace App\Models;

use Illuminate\Support\Collection;

class PaymentState {

    public $name;
    public $slug;
    public const VALUES = [
        'discharge-first-part-paid',
        'discharge-first-part-not-paid',
        'discharge-second-part-paid',
        'discharge-second-part-not-paid',
        'discharge-first-and-second-part-paid',
        'discharge-first-and-second-part-not-paid',
        'medical-visit-paid',
        'medical-visit-not-paid'
    ];

    public function __construct($name, $slug){
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function all()
    {
        $status_arr = collect([]);

        $status_arr->add(new PaymentState("Tranche 1 - payé", "discharge-first-part-paid"));
        $status_arr->add(new PaymentState("Tranche 1 - non payé", "discharge-first-part-not-paid"));

        $status_arr->add(new PaymentState("Tranche 2 - payé", "discharge-second-part-paid"));
        $status_arr->add(new PaymentState("Tranche 2 - non payé", "discharge-second-part-not-paid"));

        $status_arr->add(new PaymentState("Tranche 1 et 2 - payé", "discharge-first-and-second-part-paid"));
        $status_arr->add(new PaymentState("Tranche 1 et 2 - non payé", "discharge-first-and-second-part-not-paid"));

        $status_arr->add(new PaymentState("Visite médicale - payé", "medical-visit-paid"));
        $status_arr->add(new PaymentState("Visite médicale - non payé", "medical-visit-not-paid"));

        return $status_arr;
    }

}
