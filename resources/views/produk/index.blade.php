<x-app-layout>
    <x-slot name="css">
        <style>
            .coba{
                color: red;
            }
        </style>
    </x-slot>

    <div class="container">
        @if (session()->has('success'))
        <div class="alert alert-success mt-4" role="alert">
            {{ session('success') }}
        </div>
        @elseif(session()->has('errorss'))
        <div class="alert alert-danger mt-4" role="alert">
            {{ session('errorss') }}
        </div>
        @elseif (session()->has('errors'))
        <div class="alert alert-danger mt-4" role="alert">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                @endforeach
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="d-flex justify-content-between p-2 align-items-center">
            <h4><strong>Manajemen User</strong></h4>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Produk</button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Gambar</th>
                      <th scope="col">Status</th>
                      <th scope="col">aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produks as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$item->patch_image) }}" width="50px" height="50px" alt="">
                        </td>
                        <td>{{ $item->status }}</td>
                        <td class="">
                            <div class="h-100 d-flex">
                                <button class="btn mx-2 btn-outline-primary btn-sm btn-edit" data-name="{{ $item->name }}" data-price="{{ $item->price }}" data-id="{{ $item->id }}">Edit</button>
                                <form action="{{ route('produks.destroy',$item->id) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
          </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div>
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan Nama">
                </div>
                <div>
                    <label for="email" class="form-label">Harga</label>
                    <input class="form-control" type="number" name="price" id="price" placeholder="Masukan Harga">
                </div>

                <div>
                    <label for="password" class="form-label">Image</label>
                    <input class="form-control" type="file" accept="image/*" name="patch_image" id="patch_image" placeholder="input file">
                </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary w-100">Simpan</button>
            </div>
            </form>
          </div>
        </div>
    </div>


    {{-- MODAL TOP UP --}}
    <div id="topupModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="form-edit" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan Nama">
                        </div>
                        <div>
                            <label for="email" class="form-label">Harga</label>
                            <input class="form-control" type="number" name="price" id="price" placeholder="Masukan Harga">
                        </div>
                        <div>
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div>
                        <div>
                            <label for="password" class="form-label">Image</label>
                            <input class="form-control" type="file" accept="image/*" name="patch_image" id="patch_image" placeholder="input file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info">Update</button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $(document).on('click','.btn-edit',function (params) {
                $('#topupModal').modal('show');
                $('#form-edit').attr('action',`{{ route('produks.index') }}` + '/' + $(this).data('id')  );
                $('#form-edit input[name="name"]').val($(this).data('name'));
                $('#form-edit input[name="price"]').val($(this).data('price'));
            })
            // console.log($('#modalEdit').show())
        </script>
    </x-slot>
</x-app-layout>
