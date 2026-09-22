@extends('layout')

@section('content')
    @include('authenticated.patron.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Account History' ])
    
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <table class="table table-bordered table-sm data-table">
                                    <thead>
                                        <tr>
                                            <th class="small text-bold">ID#</th>
                                            <th class="small text-bold">From</th>
                                            <th class="small text-bold">Activity</th>
                                            <th class="small text-bold">Date/Time</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="small">
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td>{{ $history->id }}</td>
                                                <td>{{ $history->from->firstname . ' ' . $history->from->middlename . ' ' . $history->from->lastname }} @if($history->user_id == auth()->user()->id) <i class="text-muted">(Me)</i> @endif</td>
                                                <td>{{ $history->activity }}</td>
                                                <td>{{ date("F d, Y h:i A", strtotime($history->created_at)) }}</td>
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
@endsection