<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function showHeader()
    {
        $categories = Category::with('subcategories')->paginate(2);

        return view('header', compact('categories'));
    }
    public function payWithStripe()
 {
 return view('paywithstripe');
 }

 public function postPaymentWithStripe(Request $request)
 {
 $validator = Validator::make($request->all(), [
 'card_no' => 'required',
 'ccExpiryMonth' => 'required',
 'ccExpiryYear' => 'required',
 'cvvNumber' => 'required',
 'amount' => 'required',
 ]);
 $input = $request->all();
 if ($validator->passes()) { 
 $input = array_except($input,array('_token'));
 $stripe = Stripe::make('Your stripe secret key'); //set here your stripe secret key
 try {
 $token = $stripe->tokens()->create([
 'card' => [
 'number' => $request->get('card_no'),
 'exp_month' => $request->get('ccExpiryMonth'),
 'exp_year' => $request->get('ccExpiryYear'),
 'cvc' => $request->get('cvvNumber'),
 ],
 ]);
 // $token = $stripe->tokens()->create([
 // 'card' => [
 // 'number' => '4242424242424242',
 // 'exp_month' => 10,
 // 'cvc' => 314,
 // 'exp_year' => 2020,
 // ],
 // ]);
if (!isset($token['id'])) {
 return redirect()->route('addmoney.paywithstripe');
 }
 $charge = $stripe->charges()->create([
 'card' => $token['id'],
 'currency' => 'USD',
 'amount' => $request->get('amount'),
 'description' => 'Add in wallet',
 ]);
 
 if($charge['status'] == 'succeeded') {
 /**
 * Write Here Your Database insert logic.
 */
 echo "Pagament fet correctament";
 echo "<pre>";
 print_r($charge);exit();
 return redirect()->route('addmoney.paywithstripe');
 } else {
 \Session::put('error','Money not add in wallet!!');
 return redirect()->route('addmoney.paywithstripe');
 }
 } catch (Exception $e) {
 \Session::put('error',$e->getMessage());
 return redirect()->route('addmoney.paywithstripe');
 } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
 \Session::put('error',$e->getMessage());
 return redirect()->route('addmoney.paywithstripe');
 } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
 \Session::put('error',$e->getMessage());
 return redirect()->route('addmoney.paywithstripe');
 }
}
 }
}

