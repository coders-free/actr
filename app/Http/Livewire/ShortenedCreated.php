<?php

namespace App\Http\Livewire;

use App\Models\Shortened;
use Livewire\Component;
use Illuminate\Support\Str;

class ShortenedCreated extends Component
{

    public $url;

    public $shorteneds;
    public $lastShortened;

    //Shortened actual
    public $shortened;

    public function mount()
    {

        $this->getShorteneds();

    }

    public function procesarUrl()
    {
        //Expresion regular url valida http|https opcional
        $this->validate([
            'url' => ['required', 'regex:/^(http|https)?(:\/\/)?(www\.)?[a-zA-Z0-9]+([\-\.]{1}[a-zA-Z0-9]+)*\.[a-zA-Z]{2,5}(:[0-9]{1,5})?(\/.*)?$/']
        ]);

        if (!preg_match("~^(?:f|ht)tps?://~i", $this->url)) {
            $this->url = "http://" . $this->url;
        }

        $title = file_get_contents($this->url);
        preg_match('/<title>(.*)<\/title>/', $title, $matches);
        $title = $matches[1];

        Shortened::create([
            'url' => $this->url,
            'title' => $title,
            'slug' => Str::random(6),
            'user_id' => auth()->id()
        ]);

        $this->reset('url');
        
    }

    public function getShorteneds()
    {
        $this->shorteneds = auth()->user()->shorteneds()->latest()->get();

        //Ultimo link creado
        if (!$this->shortened) {
            $this->shortened = $this->shorteneds->first();
        }
    }

    public function changeShortened($shortenedId)
    {

        $this->shortened = Shortened::find($shortenedId);

    }


    public function render()
    {
        return view('livewire.shortened-created');
    }
}
