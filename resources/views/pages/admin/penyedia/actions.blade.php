<div class="flex space-x-2">
    <button wire:click="$emit('openEditModal', {{ $penyedia->penyedia_id }})" 
            class="btn btn-sm btn-warning text-gray-200">
        <i class="fa-solid fa-pen-to-square"></i>
    </button>
    
    <button wire:click="$emit('confirmDelete', {{ $penyedia->penyedia_id }})" 
            class="btn btn-sm btn-error text-white">
        <i class="fa-solid fa-trash"></i>
    </button>
</div>