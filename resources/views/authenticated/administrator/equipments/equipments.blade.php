@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Equipments' ])
    
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
                                            <th class="small text-bold">Picture</th>
                                            <th class="small text-bold">Name</th>
                                            <th class="small text-bold">Qty.</th>
                                            <th class="small text-bold">Rem. Qty.</th>
                                            <th class="small text-bold">Available</th>
                                            <th class="small text-bold">Action</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="small">
                                        @foreach ($equipments as $equipment)
                                            <tr>
                                                <td class="pt-2">{{ $equipment->id }}</td>
                                                <td class="pt-1">
                                                    <img src="{{ URL::asset('equipment-images/' . $equipment->photo_url) }}" class="rounded-circle" alt="" height="30" width="30" srcset="">
                                                </td>
                                                <td class="pt-2">{{ $equipment->name }}</td>
                                                <td class="pt-2">{{ $equipment->quantity }}</td>
                                                <td class="pt-2">{{ $equipment->remaining_quantity }}</td>
                                                <td class="pt-2 text-center @if($equipment->remaining_quantity > 0) bg-success @else bg-danger @endif">{{ $equipment->remaining_quantity > 0 ? "YES" : "NO" }}</td>
                                                <td>
                                                    <a href="/welcome/administrator/equipment/list/info.{{ $equipment->id }}" class="btn btn-light border btn-sm">
                                                        Show Info
                                                        <span class="fas fa-eye pl-1 text-warning"></span>
                                                    </a>
                                                    
                                                    @if($equipment->reservation_equipments->isEmpty())
                                                    <button onclick="removeEquipment({{ $equipment->id }})" class="btn btn-light border btn-sm">
                                                        Remove
                                                        <span class="fas fa-times pl-1 text-danger"></span>
                                                    </button>
                                                    @endif
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
        function removeEquipment(equipment_id){
            let con = confirm("Are you sure you want to remove this equipment?");
       
            if (con == true){
                window.location.href = "/welcome/administrator/equipment/list/remove." + equipment_id;
            }
        }
    </script>
@endsection