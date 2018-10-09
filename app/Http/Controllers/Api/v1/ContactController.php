<?php

namespace App\Http\Controllers\Api\v1;


use App\Contact;
use App\Http\Controllers\Traits\Responds;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Log;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Validator;
use Verifalia;

class ContactController extends Controller
{
    use Responds;
    //
    public function validate_email($email=NULL){
        $verifalia = new Verifalia\Client(env('VERIFALIA_SID'), env('VERIFALIA_PASSWORD'));
        $validation_status = null;

        try {
            // Submits the email addresses to Verifalia and waits until the engine
            // complete its validation.
            $job = $verifalia
                ->emailValidations
                ->submit($email, NULL);

            $validation_status = $job->entries[0]->status;
        }
        catch (\Exception $ex) {
            Log::info($ex);
            $validation_status = "success";
        }

        $validation_status = strtolower(trim($validation_status));
        if($validation_status == "success"){
            return true;
        }

        return false;
    }


    public function contact(Request $request){
        //$contact = Contact::where('email', $request['email'])
                       //     ->orWhere('name', $request['name'])
                       //     ->first();
        //if($contact){
         //   if($contact->is_valid) {
         //       return response('You have already contacted. Please wait for me to respond or visit www.mithunjmistry.com', 400);
         //   }
         //   else{
         //       return response('You already tried to bypass the system. Unfortunately it is not that easy. Keep trying and you will soon be blocked to submit the form.', 400);
        //    }
        //}
        if($this->validate_email($request['email'])){

            $validator = $this->makeValidation($request->all());

        if ($validator->fails()) {
         return $this->validationError($validator->errors());
        }

        $this->validate($request,[]);

            Log::info("Comes in else if loop");
            $c = new Contact();
            $c->email = $request['email'];
            $c->name = $request['name'];
            $c->message = $request['message'];
            $c->is_valid = true;
            $c->save();

        Mail::to("urchihe@gmail.com")->queue(new ContactEmail((object)$request->all()));

        return $this->success('Message Sent');
        }
        else{
            $c = new Contact();
            $c->email = $request['email'];
            $c->name = $request['name'];
            $c->message = $request['message'];
            $c->save();

            return $this->error('This is not a valid email. It is a high tech site and it obviously has an algorithm to check if your email really exists. It is not just a Regex validation! Good try', 400);
        }

    }
     protected function makeValidation($data)
    {
        return Validator::make($data, $this->validationRules($data));
    }

protected function validationRules($data)
    {
        
        return ([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]
        );
    }
protected function getKey($seckey){
  $hashedkey = md5($seckey);
  $hashedkeylast12 = substr($hashedkey, -12);

  $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
  $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);

  $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
  return $encryptionkey;

}

 protected function encrypt3Des($data, $key)
 {
  $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
 }

   public function payviacard(){ // set up a function to test card payment.
    
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    $data = array('PBFPubKey' => env('RAVE_SID'),
    'cardno' => '5438898014560229',
    'currency' => 'NGN',
    'country' => 'NG',
    'cvv' => '789',
    'amount' => '300000',
    'suggested_auth' => 'pin',
    'expiryyear'=>'19',
    'expirymonth'=>'09',
    'pin' => '3310',
    'email' => 'tester@flutter.co',
    "txRef" => "MC-".now(),// your unique merchant reference
    "redirect_url "=> "http://rave-webhook.herokuapp.com/receivepayment",
    'device_fingerprint' => '69e6b7f0sb72037aa8428b70fbe03986c');
    
    $SecKey = env('RAVE_SECRET');
    
    $key = $this->getKey($SecKey); 
    
    $dataReq = json_encode($data);
    
    $post_enc = $this->encrypt3Des( $dataReq, $key );

    var_dump($dataReq);
    
    $postdata = array(
     'PBFPubKey' => env('RAVE_SID'),
     'client' => $post_enc,
     'alg' => '3DES-24');
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/charge" );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
    curl_setopt($ch, CURLOPT_TIMEOUT, 200);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $headers = array("accept: */*",
        "Content-Type: application/json"
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $request = curl_exec($ch);
    if ($request) {
        $result = json_decode($request);
        return $this->success($result);
    }else{
        if(curl_error($ch))
        {
         return $this->error('error'). curl_error($ch);
        }
    }
    curl_close($ch);
}


}
