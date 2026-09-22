@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Patrons' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <table class="table table-bordered table-sm data-table">
                                    <thead>
                                        <tr>
                                            <th class="small text-bold">ID#</th>
                                            <th class="small text-bold">Avatar</th>
                                            <th class="small text-bold">Fullname</th>
                                            <th class="small text-bold">Role</th>
                                            <th class="small text-bold">Action</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="small">
                                        @foreach ($patrons as $user)
                                            <tr>
                                                <td class="pt-2">{{ $user->id }}</td>
                                                <td class="pt-1">
                                                    <img src="{{ URL::asset('user-images/' . $user->profile_picture) }}" class="rounded-circle" alt="" height="30" width="30" srcset="">
                                                </td>
                                                <td class="pt-2">{{ $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname . ' ' . $user->suffix }}</td>
                                                <td class="pt-2 text-center @if($user->role == "Administrator") bg-success @else bg-dark @endif">{{ $user->role }}</td>
                                                <td>
                                                    <a href="/welcome/administrator/patron/list/update.{{ $user->id }}" class="btn btn-light border btn-sm">
                                                        Update Details
                                                        <span class="fas fa-edit pl-1 text-warning"></span>
                                                    </a>
            
                                                    <button onclick="removePatron({{ $user->id }})" class="btn btn-light border btn-sm">
                                                        Remove
                                                        <span class="fas fa-times pl-1 text-danger"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function removePatron(user_id){
            let con = confirm("Are you sure you want to remove this patron?");
       
            if (con == true){
                window.location.href = "/welcome/administrator/patron/list/remove." + user_id;
            }
        }
    </script>
@endsection