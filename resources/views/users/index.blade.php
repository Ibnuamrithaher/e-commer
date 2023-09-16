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
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah User</button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="d-flex">
                            <button class="mx-2 btn btn-outline-primary btn-sm btn-edit" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-id="{{ $item->id }}">Edit</button>
                            <form action="{{ route('users.destroy',$item->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
            <div class="modal-body">
                <div>
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan Nama">
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" list="email" name="email" id="email" placeholder="Masukan Email">
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="password">
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
            <form action="" method="POST" id="form-edit">
                @method('PUT')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan Nama">
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" list="email" name="email" id="email" placeholder="Masukan Email">
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
                $('#form-edit').attr('action',`{{ route('users.index') }}` + '/' + $(this).data('id')  );
                $('#form-edit input[name="name"]').val($(this).data('name'));
                $('#form-edit input[name="email"]').val($(this).data('email'));
            })
            // console.log($('#modalEdit').show())
        </script>
    </x-slot>
</x-app-layout>
