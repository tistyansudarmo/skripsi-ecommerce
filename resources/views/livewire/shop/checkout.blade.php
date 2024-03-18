<div class="container p-3 w-75 mt-4" style="background-color: #F3F3F3">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <form wire:submit.prevent="checkout">
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" wire:model="fullName">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" wire:model="username">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" wire:model="email">
    </div>
    <div class="mb-3">
        <label for="number-phone" class="form-label">Number Phone</label>
        <input type="text" class="form-control" id="number-phone" wire:model="phoneNumber">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" wire:model="address">
    </div>
    <div class="mb-3">
        <button class="btn btn-sm btn-primary">Submit</button>
    </div>
    </form>
</div>
