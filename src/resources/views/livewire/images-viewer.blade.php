<div class="image-uploader-container rounded-lg">  
    @if (!is_null($oldImages) && !empty($oldImages))
         
            <div class="image-wrapper mb-4">
                @foreach ($oldImages as $index => $image)
                    <div
                        class="single-image">
                        <img src="{{ asset('images/' . $publicPathView . '/' . $image) }}"
                            width="" alt="">
                            
                        <button type="button"
                            wire:loading.attr="disabled" wire:target="handleRemoveImage({{ $index }}, true)"
                            wire:click.prevent="handleRemoveImage({{ $index }}, true)">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
    @else
        <div class="image-uploader-no-image">
            <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4721 2C14.3358 2 13.297 2.64201 12.7889 3.65836L12 5.23607C11.153 6.92999 9.42172 8 7.52786 8H5C3.34315 8 2 9.34315 2 11V29C2 30.6569 3.34315 32 5 32H33C34.6569 32 36 30.6569 36 29V11C36 9.34315 34.6569 8 33 8H30.4721C28.5783 8 26.847 6.92999 26 5.23607L25.2111 3.65836C24.703 2.64201 23.6642 2 22.5279 2H15.4721ZM11 2.76393C11.847 1.07001 13.5783 0 15.4721 0H22.5279C24.4217 0 26.153 1.07001 27 2.76393L27.7889 4.34164C28.297 5.35799 29.3358 6 30.4721 6H33C35.7614 6 38 8.23858 38 11V29C38 31.7614 35.7614 34 33 34H5C2.23858 34 0 31.7614 0 29V11C0 8.23858 2.23858 6 5 6H7.52786C8.66418 6 9.70297 5.35799 10.2111 4.34164L11 2.76393Z" fill="#B4B0B0"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19 12C15.134 12 12 15.134 12 19C12 22.866 15.134 26 19 26C22.866 26 26 22.866 26 19C26 15.134 22.866 12 19 12ZM10 19C10 14.0294 14.0294 10 19 10C23.9706 10 28 14.0294 28 19C28 23.9706 23.9706 28 19 28C14.0294 28 10 23.9706 10 19Z" fill="#B4B0B0"/>
            </svg>

            <label>{{ is_null($label) ? 'No image selected' : $label }}</label>
        </div>
    @endif
            
</div>
