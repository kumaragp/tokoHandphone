@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-4">Daftar Transaksi</h1>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Riwayat Transaksi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td><strong>{{ $transaction['product']['name'] }}</strong></td>
                                        <td>Rp{{ number_format($transaction['product']['price'], 0, ',', '.') }}</td>
                                        <td>
                                            @if ($transaction['status'] == 'pending')
                                                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                            @elseif ($transaction['status'] == 'success')
                                                <span class="badge bg-success">Berhasil</span>
                                            @else
                                                <span class="badge bg-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction['created_at'] }}</td>
                                        <td class="text-center">
                                            @if ($transaction['status'] == 'pending')
                                                <form action="{{ route('checkout', $transaction['id']) }}" method="GET" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $transaction['id'] }}">
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $transaction['product']['id'] }}">
                                                    <input type="hidden" name="price"
                                                        value="{{ $transaction['product']['price'] }}">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">Bayar Sekarang</button>
                                                </form>
                                            @else
                                                <button class="btn btn-outline-secondary btn-sm" disabled>Sudah Diproses</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        © {{ date('Y') }} YourWebsiteName. All Rights Reserved.
    </footer>
@endsection