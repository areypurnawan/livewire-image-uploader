<?php

namespace Sherwinchia\LivewireImageUploader\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImagesViewer extends Component
{
   use WithFileUploads;
    public $rawImages;
    public $images = [];
    public $imagesName = [];
    public $oldImages, $name, $label, $publicPath, $publicPathView;

    
    public function mount(string $name, array $old = null, string $label = null, $publicPath = 'public/image-uploader/', $publicPathView = null)
    {
        $this->name = $name;
        $this->label = $label;
      
        $old ? $this->oldImages = $old : $this->oldImages = null;
        $this->publicPath = $publicPath;
        $this->publicPathView = $publicPathView;
    }

    
    public function handleRemoveImage($index, $old = false)
    {
        if ($old) {
            $this->dispatch('deleteImage', $this->oldImages[$index], $this->publicPath, $this->publicPathView);
            unset($this->oldImages[$index]);
        } 
    }

    public function render()
    {
        return view('livewire-image-uploader::livewire.images-viewer');
    }
}
