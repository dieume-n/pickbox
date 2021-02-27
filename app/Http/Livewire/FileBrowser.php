<?php

namespace App\Http\Livewire;

use App\Models\Obj;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileBrowser extends Component
{
    use WithFileUploads;

    public $object;
    public $ancestors;
    public $creatingNewFolder = false;
    public $folder;
    public $renamingObject;
    public $renamingObjectState;
    public $showUploadFilesForm = false;
    public $upload;


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

    public function updatedUpload($upload)
    {
        $object = $this->currentTeam->objects()->make(["parent_id" => $this->object->id]);

        $object->objectable()->associate(
            $this->currentTeam->files()->create([
                "name" => $upload->getClientOriginalName(),
                "size" => $upload->getSize(),
                "path" => $upload->storePublicly(
                    "files",
                    [
                        "disk" => "local"
                    ]
                )
            ])
        );
        $object->save();

        $this->object = $this->object->fresh();
        // $upload->storePublicly("files", ["disk" => "local"]);
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
