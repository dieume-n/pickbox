<div class="space-y-4">
    <div class="flex flex-wrap items-center justify-between">
        <div class="flex-grow order-3 w-full mt-4 md:mr-3 md:mt-0 md:w-auto md:order-1">
            <x-jet-input id="search" placeholder="Search files and folders" type="search" class="block w-full mt-1" />
            <x-jet-input-error for="search" class="mt-2" />
        </div>
        <div class="order-2 sm:space-x-3">
            <button class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg"
                wire:click="$set('creatingNewFolder', true)">New folder</button>
            <button type="button" class="px-4 py-2 font-bold text-gray-100 bg-blue-600 rounded-lg"
                wire:click.prevent="$set('showUploadFilesForm', true)">Upload files</button>
        </div>
    </div>

    <div class="border border-gray-200 rounded-lg">
        <div class="px-3 py-2">
            <div class="flex items-center">
                @foreach ($ancestors as $ancestor)
                <a href="{{ route("files", ["uuid" => $ancestor->uuid]) }}"
                    class="font-bold text-gray-400">{{ $ancestor->objectable->name }}</a>
                @if (!$loop->last)
                <span class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" /></svg>
                </span>
                @endif

                @endforeach

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
                    @if ($creatingNewFolder)
                    <tr class="border-b-2 border-gray-100 hover:bg-gray-100">
                        <td class="p-3 ">
                            <form class="flex items-center h-16 space-x-2" wire:submit.prevent="createFolder">
                                <div class="relative flex-grow ">
                                    <input type="text" class="block w-full h-10 px-3 border border-gray-300 rounded-md"
                                        placeholder="Create a new folder" wire:model="folder">
                                    @error('folder') <p class="absolute left-0 text-sm text-red-600">
                                        {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="submit" class="px-4 py-2 text-gray-100 bg-blue-600 rounded-lg">
                                        Create
                                    </button>
                                    <button type="button" wire:click="$set('creatingNewFolder', false)"
                                        class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif

                    @foreach ($object->children as $child)
                    <tr class="border-b-2 border-gray-100 hover:bg-gray-100">
                        <td class="flex items-center px-3 py-2">
                            <div class="flex">
                                @if ($child->objectable_type == "file")
                                <span class="text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                @endif
                                @if ($child->objectable_type == "folder")
                                <span class="text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                </span>
                                @endif
                            </div>

                            @if ($renamingObject === $child->id)

                            <form class="flex items-center w-full h-16 ml-2 space-x-2"
                                wire:submit.prevent="renameObject">
                                <div class="relative flex-grow ">
                                    <input type="text" class="block w-full h-10 px-3 border border-gray-300 rounded-md"
                                        placeholder="Rename this object" wire:model="renamingObjectState.name">
                                    @error('renamingObjectState.name') <p class="absolute left-0 text-sm text-red-600">
                                        {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="submit" class="px-4 py-2 text-gray-100 bg-blue-600 rounded-lg">
                                        Rename
                                    </button>
                                    <button type="button" wire:click="$set('renamingObject', null)"
                                        class="px-4 py-2 text-gray-800 bg-gray-200 rounded-lg">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                            @else
                            @if ($child->objectable_type == "file")
                            <a href="" class="flex-grow p-2 font-bold text-blue-700">
                                {{ $child->objectable->name }}
                            </a>
                            @endif

                            @if ($child->objectable_type == "folder")
                            <a href="{{ route("files", ["uuid" => $child->uuid]) }}"
                                class="flex-grow p-2 font-bold text-blue-700">
                                {{ $child->objectable->name }}
                            </a>
                            @endif

                            @endif

                        </td>
                        <td class="px-3 py-2">
                            @if ($child->objectable_type == "file")
                            {{ $child->objectable->size }}
                            @else
                            &mdash;
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            {{ $child->created_at }}
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center justify-end ">
                                <ul class="flex items-center space-x-4">
                                    <li>
                                        <button type="button"
                                            class="font-bold text-gray-600 active:outline-none focus:outline-none"
                                            wire:click="$set('renamingObject', {{ $child->id }})">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($object->children->count() === 0)
        <div class="p-3 text-gray-700">
            This folder is empty
        </div>
        @endif
    </div>

    <x-jet-modal wire:model="showUploadFilesForm">

        <div wire:ignore class="m-3 border-2 border-dashed" x-data="{pond: null}" x-init="

            pond = FilePond.create($refs.filepond);
            pond.setOptions({
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('upload', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('upload', filename, load)
                    }
                },
            });

            
        ">
            <div>
                <input type="file" x-ref="filepond" multiple>
            </div>
        </div>

    </x-jet-modal>
</div>