<div>
    <div class = "d-flex justify-content-between arrow-container">
        <span class = "cursor-pointer" wire:click="$set('numberFile', '{{ $numberFile-1 }}')"><</span>
        <span class = "cursor-pointer" wire:click="$set('numberFile', '{{ $numberFile+1 }}')">></span>
    </div>
    
    <style>
        {{$css}}
        
    </style>
    
    <div style= "max-height: 100vh; min-height: 100vh; overflow: auto; p-2">
        @php echo $content @endphp
    </div>
</div>
