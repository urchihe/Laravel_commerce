<?php

namespace App\Http\Controllers\Api\v1;

use App\Notifications\RegistrationNotification;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Responds;
use Validator;

class PaymentsController extends Controller
{
    use Responds;

    public function initiatePayment(Request $request)
    {
        $validator = $this->initiatePaymentValidation($request->all());

        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $processing_fee = $this->getPrecessingFees($request->amount); 
        $confirm_payment_token = $this->generatePaymentToken();

        $user = Transaction::create([
            'seller_id' => $request->name,
            'buyer_id' => $request->email,
            'amount' => $request->phone,
            'description' => $request->phone,
            'start_at' => bcrypt($request->password),
            'deliverydays' => bcrypt($request->password),
            'end_at' => $request->is_anonymous !== null ? $request->is_anonymous : false,
            'end_at' => $request->is_anonymous !== null ? $request->is_anonymous : false,
            'role_id' => Role::where('name', 'User')->first()->id
        ]);

        if (! $user) {
            return $this->error('Unable to create new user.', 100);
        }
        $when = now()->addMinutes(10);

        $user->notify(new RegistrationNotification())->delay($when);

        return $this->created([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'is_anonymous' => $user->is_anonymous,
            'is_private' => $user->is_private,
            'zipcode' => $user->zipcode,
            'birth_year' => $user->birth_year,
            'api_token' => $api_token,
            'units' => $user->units,
        ]);
    }

    protected function initiatePaymentValidation($data, $is_update = false, $user = null)
    {
        return Validator::make($data, $this->initiatePaymentvalidationRules($data, $is_update, $user));
    }

    /**
     * @param $data
     * @param bool $is_update
     * @param User $user
     * @return array
     */
    protected function initiatePaymentvalidationRules($data, $user = null)
    {
       
             $role = User::hasRole(['both'], $user);
            if ($role) {
                $rules['trans_as'] = 'required';
            }
        
            return array_merge([
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'price' => 'required|numeric',
            'currency' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'description' => 'required|min 20',
            ], $rules);
    }
    /**
     * Generates a unique API Token
     *
     * @return string
     */
    

    public function makePayment(Request $request)
    {
        $validator = $this->makePaymentValidation($request->all());

        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }

        $transcode = $this->generateTransanctionToken();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'is_anonymous' => $request->is_anonymous !== null ? $request->is_anonymous : false,
            'is_private' => $request->is_private ? 1 : 0,
            'zipcode' => $request->zipcode,
            'api_token' => $api_token,
            'birth_year' => $request->birth_year,
            'units' => $request->units ? $request->units : 'US',
            'role_id' => Role::where('name', 'User')->first()->id
        ]);

        if (! $user) {
            return $this->error('Unable to create new user.', 100);
        }
        $when = now()->addMinutes(10);

        $user->notify(new RegistrationNotification())->delay($when);

        return $this->created([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'is_anonymous' => $user->is_anonymous,
            'is_private' => $user->is_private,
            'zipcode' => $user->zipcode,
            'birth_year' => $user->birth_year,
            'api_token' => $api_token,
            'units' => $user->units,
        ]);
    }

    protected function generateTransanctionToken($data, $is_update = false, $user = null)
    {
        return Validator::make($data, $this->makePaymentvalidationRules($data, $is_update, $user));
    }

    /**
     * @param $data
     * @param bool $is_update
     * @param User $user
     * @return array
     */
    protected function makePaymentvalidationRules($data, $is_update = false, $user = null)
    {
        $rules = [
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'cost' => 'required|numeric|digits:11',
            'currency' => 'required|numeric|digits:11',
            
        ];
    }
    /**
     * Generates a unique API Token
     *
     * @return string
     */
    protected function generateTransactionToken()
    {
        // Make sure the random string is 100% unique to our database
        $str = mt_rand(100000000000, 999999999999);;
        while (! User::where('transcode', $str)->get()->isEmpty()) {
            $str =mt_rand(1000000000, 9999999999);;
        }

        return $str;
    }
    protected function generatePaymentToken()
    {
        // Make sure the random string is 100% unique to our database
        $str = mt_rand(1000000000, 9999999999);;
        while (! User::where('confim_payment_token', $str)->get()->isEmpty()) {
            $str =mt_rand(1000000000, 9999999999);;
        }

        return $str;
    }

}


