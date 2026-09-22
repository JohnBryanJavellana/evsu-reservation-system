@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Dashboard' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-header">
                                <form method="GET">
                                    @csrf
    
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <select class="form-control form-control-sm" name="year">
                                                <option value="All">All Years</option>
                                                @for ($year = date('Y'); $year >= 2000; $year--)
                                                    <option @if(request()->year == $year)selected @endif value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
    
                                        <div class="col-xl-4">
                                            <button type="submit" class="btn btn-warning btn-sm elevation-1">
                                                Filter
                                                <span class="fas fa-filter ml-1"></span>
                                            </button>
    
                                            <a href="/welcome/administrator/dashboard" class="btn btn-light btn-sm border">
                                                Reset
                                                <span class="fas fa-undo ml-1"></span>
                                            </a>
    
                                            <button type="button" class="btn-download-pdf btn btn-light btn-sm border">
                                                Download as PDF
                                                <span class="fas fa-file-pdf text-danger ml-1"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                <div class="row chart">
                                    <div class="col-xl-12 mb-3">
                                        <label class="small">Monthly Reservations Count:</label>
                                        <canvas id="lineChart" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ URL::asset('admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        const MONTHLY_RESERVATIONS = @json($monthlyReservations);

        var labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        var categoryChartData = {
            labels: labels,
            datasets: [
                {
                    label: 'Pending',
                    backgroundColor: 'rgba(0, 0, 0, 0.09)',
                    borderColor: 'maroon',
                    borderWidth: 1,
                    data: getFilledData(MONTHLY_RESERVATIONS, 'pending')
                },
                {
                    label: 'Confirmed',
                    backgroundColor: 'rgba(0, 0, 0, 0.09)',
                    borderColor: 'green',
                    borderWidth: 1,
                    data: getFilledData(MONTHLY_RESERVATIONS, 'confirmed')
                },
                {
                    label: 'Cancelled',
                    backgroundColor: 'rgba(0, 0, 0, 0.09)',
                    borderColor: 'red',
                    borderWidth: 1,
                    data: getFilledData(MONTHLY_RESERVATIONS, 'cancelled')
                },
                {
                    label: 'Completed',
                    backgroundColor: 'rgba(0, 0, 0, 0.09)',
                    borderColor: 'orange',
                    borderWidth: 1,
                    data: getFilledData(MONTHLY_RESERVATIONS, 'completed')
                }
            ]
        };

        function getFilledData(data, status) {
            return Object.values(data).map(item => item[status] || 0);
        }

        var categoryChartCanvas = $('#lineChart').get(0).getContext('2d');
                
        var categoryChart = new Chart(categoryChartCanvas, {
            type: 'line',
            data: categoryChartData,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                }
            }
        });

        document.querySelector('.btn-download-pdf').addEventListener('click', function() {
            let pr = prompt("Enter file name:", 'chart-report');
        
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