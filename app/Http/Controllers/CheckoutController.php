<?php

namespace App\Http\Controllers;
use App\Profile;
use App\Purchase;
use Auth;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($total)
    {
        //
        $check_profile=DB::table('profiles')->where('user_id',Auth::user()->id)->exists();
        if($check_profile){
            return view('checkout.index',compact('total'));
        }
        flash('<b class="text-center" style="margin-left: 30%">Fill the form below to proceed with checkout process!</b>')->success();
        return view('profiles.add',compact('total'));

    }
    public function lipa_na_mpesa($total){
        return view('checkout.lipa_na_mpesa',compact('total'));
    }
    public function pay_via_card(Request $request,$total){
                return view('checkout.pay_via_card',compact('total'));
        //

    }
    public function confirm_details($total){
        $profile=Profile::where('id',Auth::id())->first();
        return view('checkout.checkout_details',compact('total','profile'));
    }
    public function confirm_payment(Request $request){
        $validatedData = request()->validate([
            'transaction_id' => 'string|min:10|max:10|required',
        ]);
            if ($validatedData){

                $mpesa=new \Safaricom\Mpesa\Mpesa();
                $Initiator='apitest452';
                $SecurityCredential='452reset';
                $CommandID='TransactionStatusQuery';
                $TransactionID=$request->input('transaction_id');
                $PartyA='174379';
                $IdentifierType='4'; //1 for MSISDN 2-Till Number 4-Organization short code
                $ResultURL=url('/home');
                $QueueTimeOutURL=url('/');
                $Remarks='remarks';
                $Occasion='12';
                $transactionStatus=$mpesa->transactionStatus($Initiator,$SecurityCredential,$CommandID,$TransactionID,$PartyA
                ,$IdentifierType,$ResultURL,$QueueTimeOutURL,$Remarks,$Occasion);
                if($transactionStatus==true){
                    return $transactionStatus;
                }
                return 'not yet paid';
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function lipa_na_mpesa_transaction(Request $request){
        $mpesa=new\Safaricom\Mpesa\Mpesa();
//        $ShortCode=174379;
//        $CommandID='CustomerPayBillOnline';
//        $Amount=1;
//        $Msisdn=254703646148;
//        $BillRefNumber='adala';
        $BusinessShortCode=174379;
        $LipaNaMpesaPasskey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType=1;
        $Amount=100;
        $PartyA=174379;
        $PartyB=254703646148;
        $PhoneNumber=254703646148;
        $CallBackURL='';
        $AccountReference='adala';
        $TransactionDesc='';
        $Remarks='success';
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
        if ($stkPushSimulation){
            return 'success';
        }
        return 'failure';
    }
}
