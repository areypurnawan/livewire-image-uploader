<?php

namespace Sherwinchia\LivewireImageUploader\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageUploader extends Component
{
    use WithFileUploads;
    public $rawImages;
    public $images = [];
    public $imagesName = [];
    public $multiple, $name, $size, $label, $publicPath, $publicPathView;

    protected $messages = [
        'rawImages.*.image' => 'The images format must be type of image.',
        'rawImages.*.mimes' => 'The images format must be :mimes.',
        'rawImages.*.max' => 'The images must not be greater than :max KB.',
        'rawImages.image' => 'The image format must be type of image.',
        'rawImages.mimes' => 'The image format must be :mimes.',
        'rawImages.max' => 'The image must not be greater than :max KB.',
    ];

    public function mount(string $name, bool $multiple = false, int $size = 1024, string $label = null, $publicPath = 'public/image-uploader/', $publicPathView = null)
    {
        $this->name = $name;
        $this->size = $size;
        $this->label = $label;
        $this->multiple = $multiple;
        $multiple ? $this->rawImages = [] : $this->rawImages = null;
        $this->publicPath = $publicPath;
        $this->publicPathView = $publicPathView;
    }

    public function updatingRawImages()
    {
        $this->multiple ? $this->rawImages = [] : $this->rawImages = null;
        $this->images = array();
    }

    public function updatedRawImages($value)
    {
        if ($this->multiple) {
            $this->validate(
                ['rawImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:' . $this->size],
            );
        }

        if (!$this->multiple) {
            $this->validate(
                ['rawImages' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:' . $this->size],
                []
            );
        }

        // $this->images = $value;
        $this->multiple ? $this->images = $value : $this->images = array($value);

        $this->uploadImages();
    }


    public function uploadImages()
    {

        if (!empty($this->imagesName)) {
            foreach ($this->imagesName as $image) {
                $this->dispatch('deleteImage', $image, $this->publicPath);
                Storage::delete($this->publicPath .'/' . $this->publicPathView . '/' . $image);
            }
            $this->imagesName = array();
        }

        foreach ($this->images as $image) {

            $image->store($this->publicPath.'/' . $this->publicPathView);
            array_push($this->imagesName, $image->hashName());
        }

        return $this->handleImagesUpdated();
    }

    public function handleRemoveImage($index, $old = false)
    {
        
            Storage::delete($this->publicPath.'/' . $this->publicPathView . '/' . $this->imagesName[$index]);
            $this->dispatch('deleteImage', $this->imagesName[$index], $this->publicPath);
            unset($this->images[$index]);
            unset($this->imagesName[$index]);
           // return $this->handleImagesUpdated();
    }

    public function handleImagesUpdated()
    {
        $this->dispatch('imagesUpdated', $this->name, $this->imagesName);
        // $this->dispatch('imagesUpdated', ['id' => $this->name]);
    }

    public function render()
    {
        return view('livewire-image-uploader::livewire.image-uploader');
    }
}
