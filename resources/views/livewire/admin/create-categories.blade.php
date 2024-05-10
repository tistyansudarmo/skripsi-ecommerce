<div>
    @if(session()->has('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif

    @if(session()->has('delete'))
        <div class="alert alert-success mt-4">{{ session('delete') }}</div>
    @endif

    <div class="mt-3 mb-3">
    <form wire:submit.prevent="save">
        <label for="category" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="category" wire:model="addCategory">
        <div class="text-danger">@error('addCategory') {{ $message }} @enderror</div>
    </div>
    <button type="submit" class="btn btn-primary" wire:loading.class="opacity-50" wire:target="addCategory">Submit</button>
    </form>

    <div class="mt-5 mb-3">
        <select class="form-select" wire:model="selectedCategoryId">
            <option value="">Categories</option>
            @foreach ($category as $categories)
            <option value="{{$categories->id}}">{{$categories->name}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-danger" wire:click="delete('{{ $selectedCategoryId }}')" wire:confirm="Are you sure want to delete?" wire:loading.class="opacity-50" wire:target="delete">Delete</button>

</div>
