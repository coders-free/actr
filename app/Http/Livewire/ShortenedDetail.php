<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShortenedDetail extends Component
{
    public $shortened;

    public function downloadQR()
    {

        $qr_code = QrCode::size(100)->generate($this->shortened->link);

        Storage::put("{$this->shortened->slug}.svg", $qr_code);

        return Storage::download("{$this->shortened->slug}.svg");

    }
    
    public function render()
    {
        return view('livewire.shortened-detail');
    }
}
