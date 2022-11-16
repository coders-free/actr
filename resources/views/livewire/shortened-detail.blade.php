<div class="px-4 py-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
        <h1 class="text-xl font-semibold">{{ $shortened->title }}</h1>

        <p class="py-2">
            <i class="fa-regular fa-calendar"></i>
            {{ $shortened->created_at->format('F d, Y h:i A') }} by {{ $shortened->user->name }}
        </p>

        <p>
            <i class="fa-solid fa-chart-simple ml-1"></i>
            {{ $shortened->views->count() }} visitas
        </p>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8" x-data="{
        url: '{{ $shortened->link }}',
        copied: false,
        copyToClipBoard() {
            var copyText = document.createElement('input');
            copyText.setAttribute('type', 'text');
            copyText.setAttribute('value', this.url);
            document.body.appendChild(copyText);
            copyText.select();
    
            document.execCommand('copy');
            //Eliminamos el input
            document.body.removeChild(copyText);
            //Mostramos un mensaje de que se copio el texto
            this.copied = true;
    
            setTimeout(() => {
                this.copied = false;
            }, 2000);
        }
    }">

        <div class="flex justify-between items-center">
            <a href="{{ $shortened->link }}" target="__blank"
                class="text-blue-600 font-semibold text-lg">{{ $shortened->link }}</a>

            <button class="px-4 py-2 bg-gray-100 rounded-lg shadow-lg" x-on:click="copyToClipBoard()">
                <i class="fa-solid fa-copy"></i>

                <span class="ml-2" x-text="copied ? '¡Copiado!' : 'Copiar'"></span>
            </button>
        </div>

        <p class="font-semibold">
            {{ $shortened->views->count() }} click
        </p>

        <div class="flex items-center mb-4">
            <i class="fa-solid fa-turn-up rotate-90 mr-2"></i>
            <a href="{{ $shortened->url }}" target="__blank">{{ $shortened->url }}</a>
        </div>

        <div>
            <h1 class="text-lg font-semibold">QR Code</h1>


            <div class="flex">
                {!! QrCode::size(100)->generate($shortened->link); !!}

                <x-jet-button class="ml-4" wire:click="downloadQR">
                    <i class="fa-solid fa-download"></i>
                    Descargar
                </x-jet-button>
            </div>

        </div>

    </div>

    <div wire:ignore class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8" x-data
     x-init="
        ctx = $refs.paises.getContext('2d');
        const myChart = new Chart(ctx, {
            responsive: true,
            type: 'bar',
            data: {
                labels: {{ json_encode($shortened->views->pluck('country')->unique()) }},
                datasets: [{
                    label: 'Paises',
                    data: {{ json_encode($shortened->views->pluck('country')->countBy()) }},
                }]
            }
        });
     ">
        <div>

            <div style="position: relative; height:100%" >
                <canvas x-ref="paises"></canvas>
            </div>

        </div>
    </div>


    
</div>
