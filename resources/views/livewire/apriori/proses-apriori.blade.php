<div class="container">
    @if ($formVisible)
    <form wire:submit="save">
        <label for="importTransaction" class="form-label">Import Transaction<span class="text-danger">*</span></label>
        <input type="file" class="form-control" id="importTransaction" wire:model="importTransaction" required>
        <div class="text-danger">@error('importTransaction') {{ $message }} @enderror</div>

        <label for="support" class="form-label mt-3">Minimum Support<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="support" wire:model="minSupport" required>
        <div class="text-danger">@error('minSupport') {{ $message }} @enderror</div>

        <label for="confidence" class="form-label mt-3">Minimum Confidence<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="confidence" wire:model="minConfidence">
        <div class="text-danger">@error('minConfidence') {{ $message }} @enderror</div>

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
                            <td style="vertical-align: middle;">{{ $item1->product }}</td>
                            <td style="vertical-align: middle;" class="text-center">{{ $totalTransactionItemset1[$item1->product] }}</td>
                            <td style="vertical-align: middle;">JumlahTransaksi / JumlahItem * 100</td>
                            <td style="vertical-align: middle;">{{ $itemSupport[$item1->product]}}</td>
                            <td style="vertical-align: middle;">
                                @if($itemSupport[$item1->product] >= $minSupport)
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
                        @if ($itemSupport[$item1->product] >= $minSupport)
                                <tr>
                                    <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                    <td style="vertical-align: middle;">{{ $item1->product }}</td>
                                    <td style="vertical-align: middle;">{{ $totalTransactionItemset1[$item1->product] }}</td>
                                    <td style="vertical-align: middle;">{{ $itemSupport[$item1->product] }}</td>
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
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemsets2 as $itemset)
                        <tr>
                            <th scope="row" style="vertical-align: middle;">{{ $loop->iteration}}</th>
                            <td style="vertical-align: middle;">{{ $itemset['itemset1'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset['itemset2'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset['transaksi'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset['support'] }}</td>
                            <td style="vertical-align: middle;">
                                @if ($itemset['support'] >= $minSupport)
                                Terpenuhi
                                @else
                                Tidak Terpenuhi
                                @endif
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
                            @foreach ($itemsets2 as $itemset)
                            @if ($itemset['support'] >= $minSupport)
                            <tr>
                                <th scope="row" style="vertical-align: middle;">{{ $loop->iteration}}</th>
                                <td style="vertical-align: middle;">{{ $itemset['itemset1'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset['itemset2'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset['transaksi'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset['support'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h6 class="mb-3">Itemset 3</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item 1</th>
                            <th scope="col">Item 2</th>
                            <th scope="col">Item 3</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Support</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemsets3 as $itemset3)
                            <tr>
                                <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                <td style="vertical-align: middle;">{{ $itemset3['itemset1'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset3['itemset2'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset3['itemset3'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset3['transaksi'] }}</td>
                                <td style="vertical-align: middle;">{{ $itemset3['support'] }}</td>
                                <td style="vertical-align: middle;">
                                    @if ($itemset3['support'] >= $minSupport)
                                    Terpenuhi
                                    @else
                                    Tidak Terpenuhi
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h6 class="mb-3">Itemset 3 yang lolos</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item 1</th>
                            <th scope="col">Item 2</th>
                            <th scope="col">Item 3</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemsets3 as $itemset3)
                        @if ($itemset3['support'] >= $minSupport)
                        <tr>
                            <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                            <td style="vertical-align: middle;">{{ $itemset3['itemset1'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset3['itemset2'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset3['itemset3'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset3['transaksi'] }}</td>
                            <td style="vertical-align: middle;">{{ $itemset3['support'] }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h6 class="mb-3">Association Rules</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Rules</th>
                            <th scope="col">Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($associations as $association)
                        <tr>
                            <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                            <td>{{ $association['rule'] }}</td>
                            <td>{{ number_format($association['confidence'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h6 class="mb-3">Kesimpulan</h6>
        <div>
            <div class="table-responsive container mb-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($associations as $association)
                        @if (number_format($association['confidence'], 2) >= $minConfidence)
                        <tr>
                            <td style="vertical-align: middle;">{{ $association['conclusion'] }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
