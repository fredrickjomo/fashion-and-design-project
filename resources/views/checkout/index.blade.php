@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{asset('css/payment.css')}}">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-default">
                <div class="card-header text-center">
                    <h4>Total Cost Of Your Items:: Kshs.{{$total}}</h4>
                </div>
                <div class="card-body alert-success">
                    <h5 class="alert">Choose Payment Method</h5>
                    <ul style="list-style-type: decimal">
                        <li id="mpesa">
                            <a href="{{route('lipa_na_mpesa')}}" target="_blank">Lipa Na Mpesa</a>
                            {{--<a href="" style="color: green" onclick="lipaNaMpesa()">LIPA NA M-PESA</a>--}}
                        </li>
                        <li>
                            <a href="" style="color: blue" onclick="payViaCard()">Visa Card</a>
                        </li>
                        <li>
                            <a href="" style="color: #0000F0" onclick="payViaPaypal()">Pay Pal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            function lipaNaMpesa() {
                window.open('{{url("/lipa-na-mpesa/{$total}")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=650,height=550");
            }
            function payViaCard() {
                window.open('{{url("/pay-via-card/{$total}")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=600,height=500");
            }
            function payViaPaypal() {
                window.open("{{url('/pay-via-paypal')}}","_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=600,height=500");
            }
        </script>

    </div>
</div>
    @endsection

{{--function payViaCard() {--}}
{{--window.open('{{url("/pay-via-card/{$total}")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=600,height=500");--}}
{{--}--}}