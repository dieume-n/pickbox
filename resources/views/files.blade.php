<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 space-y-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div>
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="flex-grow order-3 w-full mt-4 md:mr-3 md:mt-0 md:w-auto md:order-1">
                            <x-jet-input id="search" placeholder="Search files and folders" type="search" class="block w-full mt-1" />
                            <x-jet-input-error for="search" class="mt-2" />

                        </div>
                        <div class="order-2 sm:space-x-3"> 
                            <button class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">New folder</button>
                            <button class="px-4 py-2 font-bold text-gray-100 bg-blue-600 rounded-lg">Upload files</button>
                            {{-- <x-jet-button>
                                {{ __('Save') }}
                            </x-jet-button> --}}
                            
                        </div>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg">
                    <div class="px-3 py-2">
                        <div class="flex items-center">
                            <a href="#" class="font-bold text-gray-400">Breadcrum</a>
                            <span class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                            </span>
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="w-full">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-3 py-2 text-left">Name</th>
                                    <th class="w-2/12 px-3 py-2 text-left">Size</th>
                                    <th class="w-2/12 px-3 py-2 text-left">Created</th>
                                    <th class="w-2/12 p-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b-2 border-gray-100 hover:bg-gray-100">
                                    <td class="flex items-center px-3 py-2">
                                        <div class="flex">
                                            <span class="text-blue-700">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            </span>
                                            <span class="text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                            </span>
                                        </div>
                                        <a href="" class="flex-grow p-2 font-bold text-blue-700">File/folder name</a>
                                    </td>
                                    <td class="px-3 py-2">&mdash;</td>
                                    <td class="px-3 py-2">Created at</td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center justify-end ">                                    
                                            <ul class="flex items-center space-x-4">
                                                <li>
                                                    <button class="font-bold text-gray-600">
                                                        Rename
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="font-bold text-red-400">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="p-3 text-gray-700">
                        This folder is empty
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>