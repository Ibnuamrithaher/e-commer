<x-app-layout>
    <div class="container pt-6">
        <h4>Dashboard</h4>
        <div class="flex flex-wrap">
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Jumlah User</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">{{ $user->count() }}</h6>
                </div>
            </div>
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Jumlah User Aktif</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">{{ $user->count() }}</h6>
                </div>
            </div>
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Produk</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">{{ $produk->count() }}</h6>
                </div>
            </div>
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Produk Aktif</h5>
                  <h6 class="card-subtitle mb-2 text-body-secondary">{{ $produk->where('status','active')->count() }}</h6>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Produk</th>
                      <th scope="col">Tanggal Dibuat</th>
                      <th scope="col">Harga (Rp)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produk as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/'.$item->patch_image) }}" width="50px" alt="">
                                {{ $item->name }}
                            </div>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @currency($item->price )
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
