<?php

namespace Sherwinchia\LivewireImageUploader;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sherwinchia\LivewireImageUploader\Http\Livewire\ImageUploader;
use Sherwinchia\LivewireImageUploader\Http\Livewire\ImagesViewer;

class LivewireImageUploaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'livewire-image-uploader');
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('image-uploader'),
          ], 'assets');

        Livewire::component('image-uploader', ImageUploader::class);
        Livewire::component('images-viewer', ImagesViewer::class);
    }

    /**
     * Register the application services.
     */
    public function register() {}
}
