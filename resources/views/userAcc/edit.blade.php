@extends('index')
@section('container')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update this Account</h1>
    </div>

    <div class="col-lg-8">
        <form action="/user-account/{{ $user->id }}" method="post" class="mb-5" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name')
                is-invalid
            @enderror"
                    id="name" name="name" required value="{{ old('name', $user->name) }}" autofocus>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee ID</label>
                <input type="text"
                    class="form-control @error('employee_id')
                is-invalid
            @enderror"
                    id="employee_id" name="employee_id" required value="{{ old('employee_id', $user->employee_id) }}"
                    autofocus disabled>

                @error('employee_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">User Access</label>
                <br>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" class="btn-check" id="isAdmin" autocomplete="off" value="1"
                        name="is_admin" {{$user->is_admin ? 'checked' : ''}}>
                    <label class="btn btn-outline-primary" for="isAdmin">is Admin</label>

                    

                    <input type="checkbox" class="btn-check" id="isBanned" autocomplete="off" value="1"
                        name="is_banned" {{$user->is_banned ? 'checked' : ''}}>
                    <label class="btn btn-outline-danger" for="isBanned">is Banned</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email')
                is-invalid
            @enderror"
                    id="email" name="email" required value="{{ old('email', $user->email) }}" autofocus>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text"
                    class="form-control @error('password')
                is-invalid
            @enderror" id="password"
                    name="password" value="{{ old('password') }}" autofocus>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload image</label>
                <input type="hidden" name="oldImage" value="{{ $user->image }}">
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input type="file"
                    class="form-control @error('image')
                        is-invalid
                    @enderror"
                    id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input class="btn btn-primary" type="submit" value="Register This Account">
        </form>
    </div>


    <script>
        function previewImage() {
            // querySelector berguna untuk mengambil id atau class html
            const image = document.querySelector('#image')
            const imgPreview = document.querySelector('.img-preview');

            //atur cssnya
            imgPreview.style.display = "block";

            // baca filenya
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            //tampilkan gambarnya
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }







    </script>
@endsection
