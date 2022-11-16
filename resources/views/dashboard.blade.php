<x-app-layout>

    

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @livewire('shortened-created')

        </div>
    </div>

    {{-- <script>
        var ctx = document.getElementById('acquisitions').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Paises',
                    data: [12, 19, 3, 5, 2, 3, 1],
                }]
            }
        });
    </script> --}}

</x-app-layout>
