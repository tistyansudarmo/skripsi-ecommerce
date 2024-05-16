<div class="container">
    @if (!isset($support) && $formVisible)
    <label for="support" class="form-label">Minumum Support<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="support" wire:model="support" required >
    <button class="btn btn-danger mb-3 mt-3" wire:click="proses" style="z-index: 5000">Proses</button>
    @else
    <button class="btn btn-danger mb-3 mt-3" wire:click="back" style="z-index: 5000">Kembali</button>

    <h6 class="mb-3 mt-3">Itemset 1</h6>
    <div>
        <div class="table-responsive container mb-5">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Item</th>
                <th scope="col" class="text-center">Transaksi</th>
                <th scope="col">Perhitungan Support</th>
                <th scope="col">Support</th>
                <th scope="col">Keterangan</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($itemset1 as $item1)
                <tr>
                    <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                    <td style="vertical-align: middle;">{{ $item1->product->title }}</td>
                    <td style="vertical-align: middle;" class="text-center">{{ $item1->quantity }}</td>
                    <td style="vertical-align: middle;">JumlahTransaksi / JumlahItem * 100</td>
                    <td style="vertical-align: middle;">
                        {{ number_format($item1->quantity / $jumlahTransaksi * 100, 2)}}
                    </td>
                    @if ($support > number_format($item1->quantity / $jumlahTransaksi * 100, 2))
                    <td style="vertical-align: middle;">Tidak terpenuhi</td>
                    @else
                    <td style="vertical-align: middle;">Lolos</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>

    <h6 class="mb-3">Itemset 1 yang lolos</h6>
    <div>
        <div class="table-responsive container mb-5">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Item</th>
                <th scope="col">Transaksi</th>
                <th scope="col">Support</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" style="vertical-align: middle;"></th>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    </td>
                    <td style="vertical-align: middle;"></td>
                </tr>
            </tbody>
          </table>
        </div>
    </div>

    <h6 class="mb-3">Itemset 2</h6>
    <div>
        <div class="table-responsive container">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Item 1</th>
                <th scope="col">Item 2</th>
                <th scope="col">Transaksi</th>
                <th scope="col">Support</th>
                <th scope="col">Keterangan</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" style="vertical-align: middle;"></th>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;" class="text-center"></td>
                    <td style="vertical-align: middle;">
                        <span class="badge text-bg-warning"></span>
                    </td>
                    <td style="vertical-align: middle;"></td>
                </tr>
            </tbody>
          </table>
        </div>
    </div>
    @endif
</div>
