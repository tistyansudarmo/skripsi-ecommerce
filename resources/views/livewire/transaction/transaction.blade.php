<div>
    @if(session()->has('updateStatus'))
        <div class="alert alert-success mt-4">{{ session('updateStatus') }}</div>
    @endif

    @if ($formVisible)
    <div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="status" wire:model="newStatus">
                            <option value="">--- Pilih Status Transaksi ---</option>
                                <option value="Sedang Diproses">Sedang Diproses</option>
                                <option value="Dalam Pengiriman Jasa Ekspedisi">Dalam Pengiriman Jasa Ekspedisi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="noResi" class="form-label">Nomor Resi</label>
                        <input type="text" class="form-control" id="noResi" wire:model="noResi">
                        <div class="text-danger">@error('noResi') {{ $message }} @enderror</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" wire:click="$toggle('formVisible')" class="btn btn-light ms-2">Close</button>
                    </form>
            </div>
        </div>
    </div>
    @endif
    <div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Image</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col">No Resi</th>
                <th scope="col">Pembeli</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($transactionsPaginate as $items)
                    <th scope="row" style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</th>
                    <td>{{ $items->product->title }}</td>
                    <td class="text-center">{{ $items->quantity }}</td>
                    <td>Rp{{ number_format($items->total_price, 2, ',', '.') }}</td>
                    <td><img src="{{ asset('storage/'. $items->product->image) }}" alt="" style="width: 100px; height: 100px;"></td>
                    <td class="text-center">{{ $items->transaction->status}}</td>
                    <td></td>
                    <td>{{ $items->transaction->user->full_name }}</td>
                    <td><button class="btn btn-warning mb-3 mt-3 btn-sm" wire:click="viewStatus('{{ $items->id }}')" style="z-index: 5000">Edit</button></td>
                </tr>
                    @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="mb-5 mt-3">{{ $transactionsPaginate->links() }}</div>

</div>
