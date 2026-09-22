@extends('layout')

@section('content')
    @include('authenticated.patron.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Show Information' ])
    
        <section class="content">
            <div class="container-fluid">
                <a href="/welcome/patron/reservation/list" class="btn btn-default btn-sm">
                    <span class="fas fa-arrow-left mr-1"></span> Return
                </a>

                <button class="btn btn-default btn-sm btn-download-pdf">
                    <span class="fas fa-download mr-1 text-danger"></span> Download as PDF
                </button>
                
                <div class="row mt-2">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body chart">
                                <div class="alert alert-light rounded-0 small">
                                    <div class="w-100 text-bold">Reservation Details</div>
                                    ID#{{ $reservation->id }}
                                </div>

                                @foreach ($reservation->room_used->room_photos as $photos)
                                    <img src="{{ URL::asset('room-images/' . $photos->photo_url) }}" height="100" alt="">
                                @endforeach

                                <div class="w-100 my-3">
                                    <label class="small"><span class="text-danger">***</span> ROOM DETAILS <span class="text-danger">***</span></label>

                                    <div class="row mb-2">
                                        <div class="col-xl-6">
                                            <small><strong>Name:</strong> {{ $reservation->room_used->name }}</small>
                                        </div>

                                        <div class="col-xl-6">
                                            <small><strong>Type:</strong> {{ $reservation->room_used->type }}</small>
                                        </div>

                                        <div class="col-xl-6">
                                            <small><strong>Maximum Occupancy:</strong> {{ $reservation->room_used->max_occupancy }}</small>
                                        </div>

                                        <div class="col-xl-6">
                                            <small><strong>Address:</strong> {{ $reservation->room_used->address }}</small>
                                        </div>

                                        <div class="col-xl-6">
                                            <small><strong>Description:</strong> {{ $reservation->room_used->description }}</small>
                                        </div>

                                        <div class="col-xl-6">
                                            <small><strong>Days Occupied:</strong>
                                                {{ \Carbon\Carbon::parse($reservation->to)->diffInDays(\Carbon\Carbon::parse($reservation->from)) + 1 }} 
                                                ({{ $reservation->from . ' to ' . $reservation->to }})
                                            </small>
                                        </div>
                                    </div>

                                    <label class="small"><span class="text-danger">***</span> EQUIPMENT DETAILS <span class="text-danger">***</span></label>
                                    
                                    <table class="table table-sm table-bordered small">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty.</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($reservation->with_equipments as $eq)
                                                <tr>
                                                    <td>{{ $eq->equipment->name }}</td>
                                                    <td>{{ $eq->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="small w-100 mt-4 pt-3" style="border-top: 1px dashed rgba(0, 0, 0, 0.2)"><strong>Room Rent:</strong> ₱{{ $reservation->total_rate }}</div>
                                <div class="small w-100"><strong>Equipment Rent:</strong> ₱{{ $reservation->with_equipments->first()['total_rate'] ?? "00.00" }}</div>
                                <div class="small w-100"><strong>Grand Total:</strong> ₱{{ $reservation->total_rate + ($reservation->with_equipments->first()['total_rate'] ?? 0) }}</div>
                            
                                <div class="row">
                                    <div class="col-xl-6 small"><strong>Status:</strong></div>
                                    <div class="col-xl-6 text-bold text-right text-danger">
                                        @if ($reservation->status == "pending")
                                            <select onchange="changeStatus({{ $reservation->id }})" class="form-control form-control-sm">
                                                <option @if($reservation->status == "pending") selected @endif value="pending">Pending</option>
                                                <option @if($reservation->status == "cancelled") selected @endif value="cancelled">Cancelled</option>
                                            </select>
                                        @else
                                            {{ strtoupper($reservation->status) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function changeStatus(id){
            let val = $(`select[onchange="changeStatus(${id})"]`).val();
            window.location.href = "/welcome/patron/reservation/list/info/" + id + "/updateStatus/" + val;
        }

        document.querySelector('.btn-download-pdf').addEventListener('click', function() {
            let pr = prompt("Enter file name:", 'reservation-details');
        
            const { jsPDF } = window.jspdf;
            const margin = 10; // margin in mm
        
            html2canvas(document.querySelector('.chart')).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'legal');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth() - 2 * margin;
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        
                let position = margin;
                let pageHeight = pdf.internal.pageSize.getHeight() - 2 * margin; // Adjust height for margins
                let heightLeft = pdfHeight;
        
                // Add the first image on the first page
                pdf.addImage(imgData, 'PNG', margin, position, pdfWidth, pdfHeight);
        
                // If the content overflows, add more pages
                while (heightLeft > pageHeight) {
                    pdf.addPage();
                    position = margin; // Reset the position for the new page
                    heightLeft -= pageHeight;
        
                    // Add the next portion of the image
                    pdf.addImage(imgData, 'PNG', margin, position - heightLeft, pdfWidth, pdfHeight);
                }
        
                pdf.save(pr + '.pdf');
            });
        });
    </script>
@endsection