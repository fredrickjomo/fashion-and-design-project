<link rel="stylesheet" href="{{asset('css/app.css')}}">
<div class="container">
    <div class="card-default">
        <div class="card-header">LIPA NA M-PESA</div>
        <div class="card-body">
            <h5>To Lipa Na M-Pesa:</h5>
            <ol>
                <li><p>Go to M-pesa</p></li>
                <li><p>Lipa na M-Pesa</p></li>
                <li><p>Pay Bill</p></li>
                <li><p>Enter Business no: <b>174379</b></p></li>
                <li><p>Account no: <b>Adala</b></p></li>
                <li><p>Enter Amount: <b>Ksh. {{$total}}</b></p></li>
                <li><p>Enter M-Pesa Pin</p></li>
                <li><p>Wait for M-Pesa confirmation message and enter the transaction code below to confirm your payment.</p></li>
            </ol>
            <form action="{{route('confirm_payment')}}" method="post">
                {{csrf_field()}}
                <div class="form-group row col-md-12">
                    <label for="name" style="color: green;font-weight: bold">Transaction Code : <span class="required" style="color: red">*</span> </label>
                    <input placeholder="Transaction Id" id="transaction_id" required name="transaction_id" spellcheck="false" class="form-control{{ $errors->has('transaction_id') ? ' is-invalid' : '' }}"  />
                    @if ($errors->has('transaction_id'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('transaction_id') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group row col-md-12">
                    <input type="submit" class="btn btn-primary" value="Confirm Payment"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>