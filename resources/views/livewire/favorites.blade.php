<div>

    @if ($liked == false)
        <div wire:click="favourite" wire:model="favourite" class="btn--favourite"></div>
    @else
        <div wire:click="unfavourite" wire:model="unfavourite" class="btn--favourite--true"></div>
    @endif

</div>
