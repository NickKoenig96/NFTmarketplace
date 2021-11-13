{{-- <div wire:click="favourite('{{ $nft_id->id }}',' {{ $user_id->id }}')" wire:model="user" class="btn--favourite"></div> --}}

{{-- @foreach($nfts->nft) --}}
<div>
    <div wire:click="favourite" class="btn--favourite"></div>
    {{-- <span class="btn--count">{{ $count }}</span> --}}
    {{-- <div>{{$nft->title}}</div> --}}
</div>
{{-- @endforeach --}}


            
            {{-- <div class="btn--favourite"></div> --}}
{{-- @if ($nft->favourites->count()) --}}
    {{-- <div class="btn--favourite"></div> --}}
{{-- @else  --}}
    {{-- <div class="btn--favourite--true"></div> --}}
{{-- @endif --}}



