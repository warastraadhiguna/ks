@if(isset($user))
<form action="{{ URL::to('/admin/user/' . $user->id); }}" method="POST" autocomplete="off">
    @method('PUT')
@else
<form action="{{ URL::to('/admin/user'); }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                @enderror" placeholder="Nama" value="{{ isset($user)? $user->name : old('name') }}">
                @error('name') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid                        
                @enderror" placeholder="Username" value="{{ isset($user)? $user->username :old('username') }}">
                @error('username') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                        
            </div>         

            <div class="form-group">
                <label for="">Role</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid                        
                @enderror">
                    <option value="admin" {{ isset($user)? ("admin" == $user->role?"selected" : ""):"selected"  }}>Admin</option>
                    <option value="user" {{  isset($user)? ("user" == $user->role?"selected" : ""):""  }}>User</option>
                </select>
                @error('role') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>                        
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid                        
                @enderror" placeholder="{{ isset($user)? "kosongi jika tidak mengubah" :"*********" }}">
                @error('password') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                           
            </div>      
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" name="re_password" id="re_password" class="form-control @error('re_password') is-invalid                        
                    @enderror" placeholder="{{ isset($user)? "kosongi jika tidak mengubah" :"*********" }}">
                @error('re_password') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror  
            </div>    
        </div>    
    </div>
</form>