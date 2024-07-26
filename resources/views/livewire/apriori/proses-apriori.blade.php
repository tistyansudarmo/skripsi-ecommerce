<div class="container">
    @if ($formVisible)
    <form wire:submit="save">
        <label for="support" class="form-label">Minimum Support<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="support" wire:model="minSupport" required>
        <div class="text-danger">@error('minSupport') {{ $message }} @enderror</div>

        <label for="from" class="form-label mt-3">From</label>
        <input type="date" class="form-control" id="from" wire:model="fromDate" required>
        <label for="to" class="form-label mt-3">To</label>
        <input type="date" class="form-control" id="to" wire:model="toDate" required>
        <button class="btn btn-danger mb-3 mt-3" wire:loading.class="opacity-50" style="z-index: 5000">Proses</button>
    </form>
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
                            <td style="vertical-align: middle;" class="text-center">{{ $jumlahTransaksi[$item1->product_id] }}</td>
                            <td style="vertical-align: middle;">JumlahTransaksi / JumlahItem * 100</td>
                            <td style="vertical-align: middle;">{{ $itemSupport[$item1->product_id]}}</td>
                            <td style="vertical-align: middle;">
                                @if($itemSupport[$item1->product_id] >= $minSupport)
                                    Terpenuhi
                                @else
                                    Tidak terpenuhi
                                @endif
                            </td>
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
                        @foreach ($itemset1 as $item1)
                        @if ($itemSupport[$item1->product_id] >= $minSupport)
                                <tr>
                                    <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                    <td style="vertical-align: middle;">{{ $item1->product->title }}</td>
                                    <td style="vertical-align: middle;">{{ $jumlahTransaksi[$item1->product_id] }}</td>
                                    <td style="vertical-align: middle;">{{ $itemSupport[$item1->product_id] }}</td>
                                </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h6 class="mb-3">Itemset 2</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item 1</th>
                            <th scope="col">Item 2</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frequentItemsets2 as $index => $itemset)
                        @php
                        $itemset1 = isset($itemset[0]) ? App\Models\Product::find($itemset[0])->title : '';
                        $itemset2 = isset($itemset[1]) ? App\Models\Product::find($itemset[1])->title : '';
                        @endphp
                            <tr>
                                <th scope="row" style="vertical-align: middle;">{{ $index + 1 }}</th>
                                <td style="vertical-align: middle;">
                                    {{ $itemset1}}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ $itemset2}}
                                </td>
                                <td style="vertical-align: middle;">

                                </td>
                                <td style="vertical-align: middle;">
                                    {{ number_format($itemset2Support[$index], 2) }}
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>

         <h6 class="mb-3">Itemset 2 yang lolos</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item 1</th>
                            <th scope="col">Item 2</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Support</th>
                        </tr>
                    </thead>
                    <tbody>
                                <tr>
                                    <th scope="row" style="vertical-align: middle;"></th>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
