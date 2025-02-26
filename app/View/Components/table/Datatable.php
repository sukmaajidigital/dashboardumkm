<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicDatatable extends Component
{
    // Definisikan props yang akan diterima

    // Terima props melalui constructor
    public function __construct() {}

    public function render()
    {
        return view('components.table.datatable');
    }
}
