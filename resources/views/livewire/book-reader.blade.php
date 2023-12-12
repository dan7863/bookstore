<div>
    <div class = "d-flex justify-content-between arrow-container">
        <span class = "cursor-pointer" wire:click="$set('numberFile', '{{ $numberFile-1 }}')"><</span>
        <span class = "cursor-pointer" wire:click="$set('numberFile', '{{ $numberFile+1 }}')">></span>
    </div>
    
    <style>
        {{$css}}
        
    </style>
    
    <div style = "columns: 2; max-height: 100vh; line-height: 1.5">
        @php echo $content @endphp
    </div>
</div>
