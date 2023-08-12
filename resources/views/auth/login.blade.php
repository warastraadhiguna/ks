<div class="container mt-lg-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="text-center">
                        <strong>
                            <h4>LOGIN</h4>
                        </strong>
                    </div>
                    <p>Masukkan akses akun anda</p>

                    @if(session()->has("loginError"))
                    <div class="alert alert-danger">
                        {{ session("loginError") }}
                    </div>                        
                    @endif

                    <form action="{{ URL::to('/do-login'); }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid                        
                        @enderror" name="username" placeholder="Username"/>
                            @error('username') 
                                <div class="invalid-feedback">
                                {{ $message }}    
                                </div>                   
                            @enderror                            
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid                        
                        @enderror" name="password" placeholder="***********"/>
                        @error('password') 
                                <div class="invalid-feedback">
                                {{ $message }}    
                                </div>                   
                        @enderror                              
                        </div>          
                        <button class="btn btn-primary mt-4 px-2">Login <i class="fas fa-sign-in-alt"></i></button>              
                    </form>
                </div>
            </div>
        </div>           
        <div class="col-md-6">
            <img src="{{ URL::to('/img/login.png'); }}" width="100%"/>
        </div>        
    </div>
</div>