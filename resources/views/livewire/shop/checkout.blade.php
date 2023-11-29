<div class="container p-3 w-75 mt-4" style="background-color: #F3F3F3">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <form wire:submit.prevent="checkout">
    <div class="mb-3">
        <label for="first-name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first-name" placeholder="tistyan">
    </div>
    <div class="mb-3">
        <label for="last-name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last-name" placeholder="sudarmo">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="name@gmail.com">
    </div>
    <div class="mb-3">
        <label for="number-phone" class="form-label">Number Phone</label>
        <input type="number" class="form-control" id="number-phone" placeholder="08123456789">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" placeholder="Jalan Pegangsaan 5">
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" placeholder="Manado">
    </div>
    <div class="mb-3">
        <label for="postal" class="form-label">Postal Code</label>
        <input type="text" class="form-control" id="postal" placeholder="95114">
    </div>
    <div class="mb-3">
        <button class="btn btn-sm btn-primary">Submit</button>
    </div>
    </form>
</div>
