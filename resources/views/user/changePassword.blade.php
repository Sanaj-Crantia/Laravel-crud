<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="card p-3">
                        <h5>Change Password</h5>
                        <form action="{{ route('changePassword') }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="">
                                @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="">
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="">
                                @error('new_password_confirmation')
                                <span class="text-danger">{{ $message }}</span>    
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="{{ route('post.create') }}" class="btn btn-secondary">Back</a>
                        </form> 
                        @session('error')
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endsession
                    </div>
                </div>
            </div>
        </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>