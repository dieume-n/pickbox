<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FileBrowser extends Component
{
    public $object;
    public $ancestors;
    public $creatingNewFolder = false;
    public $folder;
    public $renamingObject;

    protected $rules = [
        "folder" => "required|max:255",
    ];

    protected $messages = [
        "folder.required" => "The folder name cannot be empty"
    ];


    public function createFolder()
    {
        $this->validate();

        $object = $this->currentTeam->objects()->make(["parent_id" => $this->object->id]);
        $object->objectable()->associate($this->currentTeam->folders()->create([
            "name" => $this->folder
        ]));
        $object->save();

        $this->reset('folder');
        $this->creatingNewFolder = false;
        $this->object = $this->object->fresh();
    }

    public function getCurrentTeamProperty()
    {
        return auth()->user()->currentTeam;
    }

    public function render()
    {
        return view('livewire.file-browser');
    }
}
