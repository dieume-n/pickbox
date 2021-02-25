<?php

namespace App\Http\Livewire;

use App\Models\Obj;
use Livewire\Component;

class FileBrowser extends Component
{
    public $object;
    public $ancestors;
    public $creatingNewFolder = false;
    public $folder;
    public $renamingObject;
    public $renamingObjectState;

    protected $rules = [
        "folder" => "required|max:255",
    ];

    protected $messages = [
        "renamingObjectState.name.required" => "The object name cannot be empty",
        "folder.required" => "The folder name cannot be empty"
    ];

    protected $renamingObjectRules = [
        "renamingObjectState.name" => "required|max:255",
    ];

    protected $renamingObjectMessages = [
        "renamingObjectState.name.required" => "The object name cannot be empty",
    ];


    public function updatingRenamingObject($id)
    {
        if ($id === null) {
            return;
        }

        if ($object = Obj::forCurrentTeam()->find($id)) {
            $this->renamingObjectState = [
                "name" => $object->objectable->name
            ];
        }
    }


    public function renameObject()
    {
        $this->validate($this->renamingObjectRules, $this->renamingObjectMessages);

        Obj::forCurrentTeam()
            ->find($this->renamingObject)
            ->objectable
            ->update($this->renamingObjectState);

        $this->reset(['renamingObject', 'renamingObjectState']);
        $this->object = $this->object->fresh();
    }


    public function createFolder()
    {
        $this->validate();

        $object = $this->currentTeam->objects()->make(["parent_id" => $this->object->id]);
        $object->objectable()->associate($this->currentTeam->folders()->create([
            "name" => $this->folder
        ]));
        $object->save();

        $this->reset(['folder', 'creatingNewFolder']);
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
