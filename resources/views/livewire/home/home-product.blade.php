<div>
<section>
    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
        <input wire:model.live="search" class="form-control mb-2"  placeholder="Find a product..." style="margin-top: 70px">
        <div class="row">
            <div class="col-md-6 mt-3 mb-3">
                <select class="form-select form-select-sm w-50" aria-label="Small select example" wire:model.live="categoryId">
                    <option value="">Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-4" id="searchInput">
            @foreach ($products as $product)
            <div class="col hp mb-3">
            <div class="card h-100 shadow-sm">
                <a href="/product/{{ $product->title }}">
                <img src="{{ asset('storage/' . $product->image) }}" loading="lazy" class="card-img-top" alt="product-image" />
                </a>
                <div class="label-top shadow-sm">
                {{ $product->title }}
                </div>

                <div class="card-body">
                <div class="clearfix mb-3">
                    <span class="float-start badge rounded-pill bg-light text-dark">Rp{{ number_format($product->price,2,",",".") }}</span>
                </div>
                <h5 class="card-title">
                    {{ $product->description }}
                </h5>

                <div class="d-grid gap-2 my-4">
                    <button wire:click='addToCart({{ $product->id }})' class="btn btn-warning bold-btn cart-btn">add to cart</button>
                </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
        <div class="mb-5">{{ $products->links() }}</div>
    </div>
</section>
</div>
