<div class="modal fade" id="view_room_{{ $room->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-static modal-dialog-scrollable" style="width: 100% !important">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <span class="text-bold">{{ $room->name }}</span><br>
                    <small>{{ $room->type }}</small>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($room->room_photos as $photos)
                    <img src="{{ URL::asset('room-images/' . $photos->photo_url) }}" height="100" alt="">
                @endforeach

                <div class="mt-2">
                    <div class="row small">
                        <div class="col-xl-3 text-bold">Description:</div>
                        <div class="col-xl-9">{{ $room->description }}</div>

                        <div class="col-xl-3 text-bold">Maximum Occupancy:</div>
                        <div class="col-xl-9">{{ $room->max_occupancy }}</div>

                        <div class="col-xl-3 text-bold">Address:</div>
                        <div class="col-xl-9">{{ $room->address }}</div>

                        <div class="col-xl-3 text-bold">Daily Rate:</div>
                        <div class="col-xl-9">₱{{ $room->daily_rate }}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Cancel</button>
                <a type="button" href="/welcome/patron/reservation/new/rent/{{ $room->id }}/{{ request()->from }}&{{ request()->to }}" class="btn btn-danger btn-sm elevation-1">
                    <span class="fas fa-book pr-1"></span>
                    Rent
                </a>
            </div>
        </div>
    </div>
</div>