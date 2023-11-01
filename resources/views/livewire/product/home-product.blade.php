
<div>
  <div class="container">
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
</div>
<div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
   <input wire:model.live="search" class="form-control mb-2" placeholder="Search....">
   <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-4">
      @foreach ($products as $product)
      <div class="col hp mb-5">
      <div class="card h-100 shadow-sm">
        <a href="#">
          <img src="storage/photos/PMp1sg20u0yXqkjWhrD7ceAQi2sToh08BxxKoyhS.png" class="card-img-top" alt="product.title" />
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
            <a href="#" class="btn btn-warning bold-btn">add to cart</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach    
  </div>
  {{ $products->links() }}
</div>
</div>
