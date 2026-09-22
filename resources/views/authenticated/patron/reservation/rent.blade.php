@extends('layout')

@section('content')
    @include('authenticated.patron.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Rent Information' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-header p-0">
                                <div class="alert alert-light rounded-0 mb-0 border-0 small">
                                    New Reservation / <strong>{{ $room->name }}</strong><br>
                                    {{ $room->type }} 
                                    <a href="#" data-toggle="modal" data-target="#view_room_{{ $room->id }}">
                                        <span class="fas fa-eye text-success"></span>
                                    </a>
                                </div>
                            </div>

                            @include('authenticated.patron.reservation.view-room-rent-page')

                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-xl-6">
                                            <label class="small">From <span class="text-danger">*</span>:</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="date" readonly value="{{ request()->from }}" class="form-control form-control-sm" required name="from" id="from_date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">date_range</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-xl-6">
                                            <label class="small">To <span class="text-danger">*</span>:</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="date" readonly value="{{ request()->to }}" class="form-control form-control-sm" required name="to" id="to_date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">date_range</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="small">Equipment:</label>

                                    <div class="table-responsive">
                                        <table class="data-table table table-bordered table-sm small text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID#</th>
                                                    <th>Photo</th>
                                                    <th>Count</th>
                                                    <th>Name</th>
                                                    <th>Qty.</th>
                                                    <th>Daily Rate</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
                                                @foreach ($equipments as $equipment)
                                                    <tr>
                                                        <td style="padding-top: 18px">{{ $equipment->id }}</td>
                                                        <td>
                                                            <img src="{{ URL::asset('equipment-images/' . $equipment->photo_url) }}" height="50" alt="">
                                                        </td>
                                                        <td style="padding-top: 12px">
                                                            <select name="count[{{ $equipment->id }}]" id="equipment_{{ $room->id }}" class="form-control form-control-sm" data-rate="{{ $equipment->daily_rate }}">
                                                                <option value="">0</option>
    
                                                                @for ($i = 1; $i <= $equipment->remaining_quantity; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </td>
                                                        <td style="padding-top: 18px">{{ $equipment->name }}</td>
                                                        <td style="padding-top: 18px">{{ $equipment->remaining_quantity }}</td>
                                                        <td style="padding-top: 18px">₱{{ $equipment->daily_rate }}</td>                                                   
                                                        <td style="padding-top: 18px">{{ $equipment->description }}</td>                                                   
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="small w-100 mt-4 pt-3" style="border-top: 1px dashed rgba(0, 0, 0, 0.2)"><strong>Room Rent:</strong> ₱<span id="room_total">0.00</span></div>
                                    <div class="small w-100"><strong>Equipment Rent:</strong> ₱<span id="equipment_total">0.00</span></div>
                                    <div class="small w-100 mb-3"><strong>Grand Total:</strong> ₱<span id="grand_total">0.00</span></div>
                                    
                                    <input type="hidden" name="room_rent" id="room_total2">
                                    <input type="hidden" name="equipment_rent" id="equipment_total2">
                                    <input type="hidden" name="grand_total" id="grand_total2">

                                    <button class="btn btn-danger btn-sm elevation-1" type="submit">
                                        <span class="fas fa-save mr-1"></span> Upload Details
                                    </button>

                                    <a href="/welcome/patron/reservation/new" class="btn btn-default btn-sm">
                                        <span class="fas fa-arrow-left mr-1"></span> Return to New Reservation
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const dailyRentRate = {{ $room->daily_rate }};
        let room_total = 0;
        let equipment_total = 0;
    
        // Function to calculate the date difference in days
        function getDateDifferenceInDays(fromDate, toDate) {
            const date1 = new Date(fromDate);
            const date2 = new Date(toDate);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Add 1 day
            return diffDays;
        }

        // Function to format numbers with commas
        function formatWithCommas(number) {
            return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Update global variables in calculateEquipmentRent and calculateRoomRent
        function calculateEquipmentRent() {
            equipment_total = 0;
            const selects = document.querySelectorAll('select[name^="count"]');

            selects.forEach((select) => {
                const quantity = parseInt(select.value);
                const rate = parseFloat(select.getAttribute('data-rate'));

                if (quantity > 0) {
                    equipment_total += quantity * rate;
                }
            });

            document.getElementById('equipment_total').innerText = formatWithCommas(equipment_total);
            document.getElementById('equipment_total2').value = formatWithCommas(equipment_total);
            calculateGrandTotal();
        }

        function calculateRoomRent() {
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;

            if (fromDate && toDate) {
                const days = getDateDifferenceInDays(fromDate, toDate);
                room_total = days * dailyRentRate;

                document.getElementById('room_total').innerText = formatWithCommas(room_total);
                document.getElementById('room_total2').value = formatWithCommas(room_total);
                calculateGrandTotal();
            }
        }

        function calculateGrandTotal() {
            document.getElementById('grand_total').innerText = formatWithCommas(room_total + equipment_total);
            document.getElementById('grand_total2').value = formatWithCommas(room_total + equipment_total);
        }

        // Add event listeners
        document.querySelectorAll('select[name^="count"]').forEach((select) => {
            select.addEventListener('change', () => {
                calculateEquipmentRent();
                calculateGrandTotal();
            });
        });

        calculateRoomRent();
    </script>
@endsection