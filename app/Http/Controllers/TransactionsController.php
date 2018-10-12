<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Transaction;
use App\Country;
use App\Pepperest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\Responds;
use Validator;
 /**
     * @param $data
     * @param bool $is_update
     * @param User $user
     * @return array
     */
class TransactionsController extends Controller
{
	use Responds;

    public function start_transaction(Request $request)
    {
        $user = $request->user();
    	$validator = $this->initiatePaymentValidation($request->all(), $user);

        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $processing_fee = $this->getprecessingFees($request->amount);
        $pepperest_fee = $this->getpepperestFees($request->amount);
        $deliverdays = $this->getdeliverydays($request->start_date, $request->end_date); 
        $trans_code = $this->generateTransToken();

        if($request->customer_type == strtolower('buyer'))
        {

            $buyer = $request->user();
            $buyer_id = $buyer->id; 
            $seller_id = $this->check_seller($request->phone, $request->phone);
        	$confirm_token = $this->generateConfirmToken();

        }else if($request->customer_type == strtolower('seller'))
        {
            $email = $request->email;
            $seller = $request->user();
            $seller_id = $seller->id;
            $buyer_id = $this->check_buyer($request->email, $request->phone);
            $confirm_token = '';
        }
        $transaction = Transaction::create([
            'amount' => $request->amount,
            'seller_id' => $seller_id,
            'buyer_id' => $buyer_id,
            'description' => $request->description,
            'confirm_token' => $confirm_token,
            'transcode' => $trans_code,
            'currency_id' => $request->currency,
            'initiated_as' => $request->customer_type,
            'fulfill_days' => $deliverdays,
            'pepperest_fee' =>$pepperest_fee,
            'escrow_fee' => $processing_fee,
            'end_at' => $request->end_date,
            'start_at' => $request->start_date,
        ]);

        if (!$transaction) {
            return $this->error('Unable to create new transaction.', 100);
        }
        $when = now()->addMinutes(10);

        $user->notify(new RegistrationNotification())->delay($when);

        return $this->created([
            'trans_id' => $transaction->id,
            'trans_code' => $transaction->name,
            'start_date' => $transaction->email,
            'end_date' => $transaction->phone,
            'amount' => $transaction->is_anonymous,
            'pepperest_fee' => $transaction->is_private,
            'escrow_fee' => $transaction->zipcode,
            'deliverydays' => $transaction->birth_year,
            'currency' => $transaction,
        ]);
    }

    public function stop_transaction()
    {
      
    }

    public function edit_transaction()
    {
      
    }

    public function get_transaction()
    {
      
    }

     protected function initiatePaymentValidation($data, $user = null)
    {
        return Validator::make($data, $this->starttransactiontvalidationRules($data, $user));
    }

   
    protected function starttransactiontvalidationRules($data,$user = null)
    {   

    	$rules = [
            'customer_type' => 'required',
        ];
       
        if (isset($data['customer_type'])) {
            if( $data['customer_type'] === strtolower('buyer')) {
                $rules = [
                'seller_email' => 'required|unique:users,email,'.$user->id,
                'seller_phone' => 'required|numeric|digits:11|unique:users,phone,'.$user->phone,
                'email' => 'required|numeric|digits:11|unique:users',
                'phone' => 'required|numeric|digits:11|unique:users',
            ];
            }else if($data['customer_type'] == strtolower('seller'))
            {
                $rules = [
                'buyer_email' => 'required|email|unique:users',
                'buyer_phone' => 'required|numeric|digits:11|unique:users'
            ];
            }}
            return array_merge([
            'amount' => 'required|numeric',
            'description' => 'required|min:15|max:255',
            'start_date' => 'date_format:Y-m-d|required|after:'.Carbon::yesterday(),
            'end_date' => 'date_format:Y-m-d|required|after_or_equal:start_date',
            'currency' => 'required',
            
        ], $rules);
    }
    /**
     * Generates a unique API Token
     *
     * @return string
     */
    private function generateTransToken()
    {
        // Make sure the random string is 100% unique to our database
        $str = mt_rand();
        while (!Transaction::where('transcode', $str)->get()->isEmpty()) {
            $str = mt_rand();
        }
        return $str;
    }
    private function generateConfirmToken()
    {
        // Make sure the random string is 100% unique to our database
        $str = mt_rand();
        while (!Transaction::where('confirm_token', $str)->get()->isEmpty()) {
            $str = mt_rand();
        }

        return $str;
    }
    protected function getprecessingFees($amount){
     $processor_fees = 1.4;
     $escrow = $processor_fees/100  * $amount;

     return $escrow;
    }
    protected function getpepperestFees($amount){
     $pepperest_fees = 1.1; $amt = 100;
     $fees = ($pepperest_fees/100 * $amount  + $amt );

     return $fees;
    }
    protected function getdeliverydays($start_date, $end_date){

       $days = round(abs(strtotime($start_date)-strtotime($end_date))/86400);
       return $days;
    }
    public function check_buyer($email, $phone){
    $user = User::where('email', $email)->get();
     if($user){
     $buyer = User::where('email', $email)->first()->id;
    }else{
        $user = User::create([
        'name' => '',
        'email' => $email,
        'phone' => $phone,
        'country_id' => Country::find(2)->id,
        'password' => bcrypt('uchenna'),
        'is_anonymous' => $request->is_anonymous !== null ? $request->is_anonymous : false,
        'api_token' => $api_token,
        ]);
        if($user){
          $buyer = $user->id;
        };
        return $buyer;
     }
   }
    public function check_seller($email, $phone){
       $user = User::where('email', $email)->get();
       $api_token = $this->generateAPIToken();
     if($user){
     $seller = User::where('email', $email)->first()->id;
    }else{
        $user = User::create([
        'name' => 'okey',
        'email' => $email,
        'phone' => $phone,
        'country_id' => Country::find(2)->id,
        'password' => bcrypt('uchenna'),
        'is_anonymous' => $request->is_anonymous !== null ? $request->is_anonymous : false,
        'api_token' => $api_token,
        ]);
        if($user){
          $seller = $user->id;

        };
        return $seller;
    }
    }
     protected function generateAPIToken()
    {
        // Make sure the random string is 100% unique to our database
        $str = str_random(60);
        while (! User::where('api_token', $str)->get()->isEmpty()) {
            $str = str_random(60);
        }

        return $str;
    }
    
}
