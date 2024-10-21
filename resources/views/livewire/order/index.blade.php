<div>
    <div class="table-responsive container" style="margin-top: 100px">
            @if(session()->has('checkoutCart'))
            <div class="alert alert-success mt-4">{{ session('checkoutCart') }}</div>
            @endif
            @if(session()->has('checkoutSingleProduct'))
            <div class="alert alert-success mt-4">{{ session('checkoutSingleProduct') }}</div>
            @endif
            <div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Shipping Cost</th>
                <th scope="col">Total Price</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Expedition</th>
                <th scope="col">Etd</th>
                <th scope="col">No Resi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($status as $item)
                <tr>
                    <th scope="row" style="vertical-align: middle;">{{ $loop->iteration + $offset }}</th>
                    <td style="vertical-align: middle;">{{ $item->product->name}}</td>
                    <td style="vertical-align: middle;" class="text-center">{{ $item->quantity }}</td>
                    <td style="vertical-align: middle;">Rp{{ number_format($item->price, 2, ',', '.') }}</td>
                    <td style="vertical-align: middle;">Rp{{ number_format($item->shipping_cost, 2, ',', '.') }}</td>
                    <td style="vertical-align: middle;">Rp{{ number_format($item->total_price, 2, ',', '.') }}</td>
                    <td><img src="{{ asset('storage/' . $item->product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
                    <td style="vertical-align: middle;">
                        <span class="badge text-dark">{{ $item->status }}</span>
                    </td>
                    <td style="vertical-align: middle;">{{  strtoupper($item->courier)  }} {{$item->shipping_service }}</td>
                    <td style="vertical-align: middle;">{{ $item->estimate }} days</td>
                    <td style="vertical-align: middle;">?</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Don't have an order yet.</td>
                </tr>
                @endforelse
            </tbody>
            {{-- <p>Total Price : Rp{{ number_format($item->total_price, 2, ',', '.') }}</p> --}}
        </table>
        </div>
        <div class="mt-2">{{ $status->links() }}</div>
      </div>
</div>
