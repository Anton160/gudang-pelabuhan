    @extends('index')

    @section('container')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">User Account</h1>
    
        </div>
    
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('ilegal'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('ilegal') }}
            </div>
        @endif
        @if (session()->has('update'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('update') }}
            </div>
        @endif
        @if (session()->has('destroy'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('destroy') }}
            </div>
        @endif
        <div class="table-responsive col-lg-8">
            <a href="/user-account/create" class="btn btn-primary mb-3">Create Account</a>
            <form action="/user-account">
            <div class="input-group mb-4">
    
                <input type="text" class="form-control" placeholder="Search.." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    
            <table class="table table-striped table-sm col-lg-8">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Employee_id</th>
                        <th scope="col">Action</th>
    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
    
                    <tr>
                        {{-- $loop->iteration variabel laravel untuk mempermudah looping
                            ini bikin angka mulai dari 1 setiap kali nge loop dan terus bertambah --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->employee_id }}</td>
                        <td>
                            
    
                            <a href="/user-account/edit/{{ $user->id }}" class="badge bg-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg></a>
                            <form action="/userdelete/{{$user->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Hapus data, apakah anda yakin')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                      </svg></button>
                            </form>
    
                        </td>
                    </tr>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        {{ $users->onEachSide(2)->links() }}
                    </div>
                </tbody>
            </table>
        </div>
    @endsection
    