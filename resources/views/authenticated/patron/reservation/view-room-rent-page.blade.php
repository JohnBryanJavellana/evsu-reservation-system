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
                        <div class="col-xl-2 text-bold">Description:</div>
                        <div class="col-xl-10">{{ $room->description }}</div>

                        <div class="col-xl-2 text-bold">Maximum Occupancy:</div>
                        <div class="col-xl-10">{{ $room->max_occupancy }}</div>

                        <div class="col-xl-2 text-bold">Address:</div>
                        <div class="col-xl-10">{{ $room->address }}</div>

                        <div class="col-xl-2 text-bold">Daily Rate:</div>
                        <div class="col-xl-10">₱{{ $room->daily_rate }}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>