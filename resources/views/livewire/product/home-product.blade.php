
<div>
<div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
    <select name="" id="" wire:model.live="paginate">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
        </select>
         <input wire:model.live="search">
   <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-4">
      @foreach ($products as $product)
      <div class="col hp mb-5">
      <div class="card h-100 shadow-sm">
        <a href="#">
          <img src="{{ asset('storage/' .  $product->image ) }}" class="card-img-top" alt="product.title" />
        </a>
        <div class="label-top shadow-sm">
          <a class="text-white" href="#">{{ $product->title }}</a>
        </div>
        
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-dark">Rp{{ number_format($product->price,2,",",".") }}</span>
            <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link">reviews</a></span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">{{ $product->description }}</a>
          </h5>

          <div class="d-grid gap-2 my-4">
            <a href="#" class="btn btn-warning bold-btn">add to cart</a>
          </div>
          <div class="clearfix mb-1">
            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>
            <span class="float-end">
              <i class="far fa-heart" style="cursor: pointer"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    @endforeach    
  </div>
  {{ $products->links() }}
</div>
</div>
