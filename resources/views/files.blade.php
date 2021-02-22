<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <livewire:file-browser :object="$object" :ancestors="$ancestors" />
            </div>
        </div>
    </div>
</x-app-layout>