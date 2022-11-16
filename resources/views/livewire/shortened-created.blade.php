<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-12">
                    
        <form wire:submit.prevent="procesarUrl()">

            <div class="flex items-center">

                <x-jet-input wire:model="url" type="text" class="w-full" placeholder="Search" />

                <x-jet-button class="ml-4">
                    Agregar
                </x-jet-button>

            </div>

            <x-jet-input-error for="url" class="mt-2" />

        </form>

    </div>


    @if ($shorteneds->count())


        <div class="bg-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid grid-cols-4 divide-x divide-gray-200">

                <div class="col-span-1">
                    <div class="px-4 py-2 border-b">
                        <p class="font-semibold">{{$shorteneds->count()}} url's encontradas</p>
                    </div>

                    <ul class="divide-y divide-gray-200">
                        @foreach ($shorteneds as $item)
                            <li wire:click="changeShortened({{$item->id}})" class="p-4 cursor-pointer {{$shortened->id == $item->id ? 'bg-white' : ''}}">
                                
                                <p class="text-xs">{{$item->created_at->format('d M')}}</p>
                                <p>{{ $item->link}}</p>

                                <div class="flex justify-between">
                                    <span class="text-xs text-red-500 font-semibold">
                                        {{ $item->link}}
                                    </span>

                                    <span class="text-sm">
                                        {{$item->views->count()}} <i class="fa-solid fa-chart-simple ml-1"></i>
                                    </span>
                                </div>
                                
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-span-3">

                    @livewire('shortened-detail', ['shortened' => $shortened], key($shortened->id))

                </div>

            </div>
        </div>


    @endif


</div>    
