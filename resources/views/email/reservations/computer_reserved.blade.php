@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img width="100px" src="{{asset('images/utech/icon.png')}}">
            <br>
            <h1 style="text-align:center">{{config('app.name')}}</h1>
        @endcomponent
    @endslot
{{-- Body --}}
    Hello {{ $reservation->reservedBy->name }},

{{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            <p>
                Your request to reserve {{$reservation->computer->name}} in {{$reservation->computer->lab->name}} 
                for the period: 
                {{date("l jS \\of F Y h:i:s A", strtotime($reservation->start_date))}} - {{date("l jS \\of F Y h:i:s A", strtotime($reservation->end_date))}} 
                Has been confirmed.                
            </p>
            <br>    
            <a href="{{ route('reserve.computer', $reservation->computer->id) }}" class="button button-primary" target="_blank">
                View Computer Schedule
            </a>
            
            <br>
            
            <p>
            regards,<br><br>
            SCIT LAB
            </p>
        @endcomponent
    @endslot

{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent