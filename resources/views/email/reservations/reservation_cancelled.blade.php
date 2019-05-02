<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="header">
                        <a href="{{ config('app.url') }}">
                            <img width="100px" src="{{asset('images/utech/icon.png')}}">
                            <br>
                            <h1 style="text-align:center">{{config('app.name')}}</h1>
                        </a>
                    </td>
                </tr>
                

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        <p>Hello {{ $reservation->reservedBy->name }},</p> <br><br>

                                       <p>
                                            Your request to cancel your reservation for {{$reservation->computer->name}} in {{$reservation->computer->lab->name}} 
                                            for the <b>period: 
                                            {{date("l jS \\of F Y h:i A", strtotime($reservation->start_date))}} - {{date("l jS \\of F Y h:i A", strtotime($reservation->end_date))}} 
                                            </b>Has been confirmed.                
                                        </p>
                                        <br>    
                                        <a href="{{ route('reserve.computer', $reservation->computer->id) }}" class="button button-primary" target="_blank">
                                            View Computer Schedule
                                        </a>

                                        <br><br><br>
                                        
                                        <p>
                                            regards,<br><br>
                                            SCIT LAB
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
