@include('sweetalert::alert')

<a href="{{ URL::to('/admin/user/create'); }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Tambah</a>  
  <table id="example2" class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>            
            <th width="20%">Action</th>                                    
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name  }}</td>
            <td>{{ $user->username  }}</td>
            <td>{{ $user->role  }}</td>            
            <td>
                <div class="d-flex">
                    <a href="{{ URL::to('/admin/user/' . $user->id . "/edit") }}" class="btn btn-success mx-2 btn-sm"> <i class="fas fa-edit    "></i> Edit</a>  
                    
                    <form action="{{ URL::to('/admin/user/' . $user->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Hapus</button>      
                    </form>
                </div>
           
            </td>                                    
        </tr>            
        @endforeach
    </tbody>
</table>