@extends('layouts.main')

@section('content')
    <div class="alert alert-info">
       Welcome <i class="fa fa-exclamation"></i> Here you will be able to see all your reservations <i class="far fa-calendar-alt"></i>.
    </div>

    <input type="hidden" id="csrf" value="{{csrf_token()}}">

    <div class="card">
        <div class="card-header">
            All Reservations
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Lab</th>
                            <th>Computer</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Reserved By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $current = time() - strtotime(date('Y-m-d H:s')) @endphp
                    @foreach($reservations as $reservation)
                        @php $end_time = time() - strtotime($reservation->end_date) @endphp
                        <tr>
                            <td>{{$reservation->computer->lab->name}}</td>
                            <td>{{$reservation->computer->name}}</td>
                            <td>{{date("d/m/Y", strtotime($reservation->start_date))}}</td>
                            <td>{{date("h:s a", strtotime($reservation->start_date))}}</td>
                            <td>{{date("h:s a", strtotime($reservation->end_date))}}</td>
                            <td>{{$reservation->status->name}}</td>
                            <td>{{$reservation->reservedBy->name}}</td>
                            <td>
                                @if($reservation->status->name == "Active" && $current >= $end_time)
                                    <button onclick="cancel_reservation({{$reservation->id}})" class="btn btn-warning">Cancel Reservation</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(count($reservations) == 0)
                        <tr>
                            <td colspan="100%">You haven't made any reservations as yet.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$reservations->links()}}
@endsection

@section('scripts')
<script type="text/javascript">
    async function cancel_reservation(reservation_id){
        Swal.fire({
            title: 'Are you sure?',
            // text: "You want to reschedule " + str,
            type: 'warning',
            showCancelButton: true,
            text: "Cancelling this reservation cannot be undo.",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel!',
            cancelButtonText: 'Close'
            }).then((result) => {
                var updatedData = {_token: $('#csrf').val(), _method: 'DELETE'};
                console.log(updatedData);
                if (result.value) {
                    $.post('/computer-reservations/'+ reservation_id, updatedData)
                    .done(function( data ) {  

                        iziToast.success({
                            title: 'OK',
                            position: 'topCenter',
                            message: 'Reservation successfully cancelled'
                        });

                        setTimeout(function(){                        
                            window.location.reload();
                        }, 3000);
                    })
                    .fail(function(xhr, status, error) {        
                        iziToast.error({
                            title: 'FAILED!',
                            position: 'topCenter',
                            message: 'Unable to cancel reservation for: ' + info.event.title
                        });
                    });
                    
                }
            });
        
            return false;
    }
</script>
@endsection
