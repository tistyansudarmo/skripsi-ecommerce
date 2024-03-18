<div>
  {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="row-10 info-panel">
            <div class="col-lg">
                <img src="images/blouse.png" alt="" class="float-left" />
                <h4>Kemeja & Blouse</h4>
            </div>
            <div class="col-lg">
                <img src="images/jumpsuit.png" alt="" class="float-left" />
                <h4>Jumpsuit</h4>
            </div>
            <div class="col-lg">
                <img src="images/bodysuit.png" alt="" class="float-left" />
                <h4>Bodysuit</h4>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
   <input wire:model.live="search" class="form-control mb-2" placeholder="Find a product" style="margin-top: 60px">
   <div class="row">
    <div class="col-md-6 mt-5 mb-3">
        <select class="form-select form-select-sm w-25" aria-label="Small select example">
            <option selected>Categories</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
   </div>
   <div class="row row-cols-2 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-4">
      @foreach ($products as $product)
      <div class="col hp mb-5">
      <div class="card h-100 shadow-sm">
        <a href="#">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="product.title" />
        </a>
        <div class="label-top shadow-sm">
          <a class="text-white text-decoration-none" href="#">{{ $product->title }}</a>
        </div>

        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-light text-dark">Rp{{ number_format($product->price,2,",",".") }}</span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">{{ $product->description }}</a>
          </h5>

          <div class="d-grid gap-2 my-4">
            <button wire:click='addToCart({{ $product->id }})' class="btn btn-warning bold-btn">add to cart</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  {{ $products->links() }}
</div>
</div>
