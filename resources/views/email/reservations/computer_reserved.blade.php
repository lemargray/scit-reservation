@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/utech/icon.png')}}">
            <br>
            <h1>{{config('app.name')}}</h1>
        @endcomponent
    @endslot
{{-- Body --}}
    Hello {{ $reservation->reservedBy->name }},

    <p>Your request to reserve {{$reservation->computer->name}} for the period: {{$reservation->start_date}} - {{$reservation->end_date}}
        Has been confirmed.
    </p>
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Super FOOTER!
        @endcomponent
    @endslot
@endcomponent