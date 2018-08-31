<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>
    .pay{
        margin-top: 5%;
        margin-bottom: 20%;
    }
</style>
<div class="container pay">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header" style="text-align: center; font-weight: bold; font-size: 30px">You're about to pay Kshs.{{$total}}</div>
                <div class="card-body">
                    <style>
                        .visacard{
                            margin-bottom: 10%;
                        }
                    </style>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

                    <div class="container visacard ">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div id="dropin-container"></div>
                                {{--<input type="hidden" value="{{$total}}" name="total" id="total">--}}
                                <button id="submit-button" class="btn btn-primary col-md-4">Pay</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        var button = document.querySelector('#submit-button');
//                        var total=

                        braintree.dropin.create({
                            authorization: "{{ Braintree_ClientToken::generate() }}",
                            container: '#dropin-container'
                        }, function (createErr, instance) {
                            button.addEventListener('click', function () {
                                instance.requestPaymentMethod(function (err, payload) {
                                    $.get('{{route('checkout') }}', {payload}, function (response) {
                                        if (response.success) {
                                            alert('Payment successfull!.Thank you for your purchase');
                                        } else {
                                            alert('Payment failed.Try again');
                                        }
                                    }, 'json');
                                });
                            });
                        });
                    </script>

                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>