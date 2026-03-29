<div class="image-uploader-container rounded-lg">
    @if ($images)
        <div class="image-wrapper">
            @foreach ($images as $index => $image)
                <div
                    class="single-image mb-4">
                    <img src="{{ $image->temporaryUrl() }}"
                        alt="uploaded-image">
                    <label
                        class="">{{ $image->getClientOriginalName() }}</label>
                    <button type="button"
                        wire:loading.attr="disabled" wire:target="handleRemoveImage({{ $index }})"
                        wire:click.prevent="handleRemoveImage({{ $index }})">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
    <div class="input-wrapper">
        <input id="imagesInput" type="file" accept="image/*" wire:model="rawImages" {{ $multiple ? 'multiple' : null }}>
        <div class="drop-zone">
            
            <div wire:loading wire:target="rawImages">
                <div class="text-gray-400 flex gap-2">
                    <flux:icon.loading variant="solid"/>
                    <span>Mengunggah...</span>
                </div>
            </div>
            

            
            <p wire:loading.remove wire:target="rawImages" class="text-gray-400">
                
                @if ($multiple)
                    Seret beberapa foto untuk mengunggah
                    <br />
                    atau <br> Pilih foto
                    
                @else
                    Seret foto untuk mengunggah
                    <br />
                    atau <br> Pilih foto
                @endif
            </p>
        </div>
    </div>
    @error('rawImages.*') <span class="error-msg">{{ $message }}</span>@enderror
    @error('rawImages') <span class="error-msg">{{ $message }}</span>@enderror
</div>
