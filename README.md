# dotpay

Dotpay for laravel (5.2, 5.3, 5.4)

#Installation
<div class="highlight highlight-source-shell"><pre>composer require gerro/dotpay</pre></div>

Add provider to /config/app.php
<div class="highlight highlight-source-shell"><pre>Gerro\Dotpay\GerroDotpayServiceProvider::class,</pre></div>

Add aliases to /config/app.php
<div class="highlight highlight-source-shell"><pre>'Dotpay'=> Gerro\Dotpay\Facades\Dotpay::class,</pre></div>

Copy to command
<div class="highlight highlight-source-shell"><pre>php artisan vendor:publish --provider="Gerro\Dotpay\GerroDotpayServiceProvider"</pre></div>

#Config/dotpay.php
<div class="highlight highlight-source-shell">
<pre>
return [
	#id,pin
	'Account'=>[
		'dotpayId'=>'123456',
		'dotpayPin'=>'IvvvSbaR8J9YD3MF5nnr67CvTa1KVVVV'
	],
	#url
	'Services'=>[
		'production'=>'https://ssl.dotpay.pl/t2/',
		'test'=>'https://ssl.dotpay.pl/test_payment/'
	]
];
</pre>
</div>

#Routes.php
If you want to test it to add to the line
<div class="highlight highlight-source-shell">
<pre>Route::get('/','DotpayController@start');
Route::post('/dotpay','DotpayController@dotpay');
Route::post('/end','DotpayController@end');</pre>
</div>

#Middleware/VerifyCsrfToken.php
<div class="highlight highlight-source-shell">
<pre>
protected $except = [
        '/dotpay',
        '/end'
    ];
</pre>
</div>

#DotpayController.php
<div class="highlight highlight-source-shell">
<pre>
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Dotpay;
class DotpayController extends Controller
{
    public function start(){

        ##### STEP 1 #####
        //parameters
        $ParametersArray = array(
             "api_version" => "dev",
             "amount" => "11.07",
             "currency" => "PLN",
             "description" => "Platnosc za zamowienie 567915976",
             "control" => "12345",
             "url" => "http://example.com/end",
             "type" => "3",
             "buttontext" => "Wroc do poprzedniej strony !",
             "urlc" => "http://example.com/dotpay",
             "firstname" => "Jan",
             "lastname" => "Nowak",
             "email" => "jan.nowak@example.com",
             "street" => "Warszawska",
             "street_n1" => "1",
             "city" => "Krakow",
             "postcode" => "12-345",
             "phone" => "123456789",
             "country" => "POL"
             );
        ##### STEP 2 #####
        //parameters setting
        $ParametersSetArray = Dotpay::parametersSetArray($ParametersArray);
        ##### STEP 3 #####
        //generator chk
        $chkValue = Dotpay::chkValue($ParametersSetArray);
        ##### STEP 3 #####
        //production or test
        $environment = Dotpay::environment('test');
        ##### STEP 4 #####
        //method POST or GET
        $redirectionMethod = Dotpay::redirectionMethod('POST');
        ##### STEP 5 #####  
        //Button automaticy
        $button = Dotpay::buttonDotpay($environment,$redirectionMethod,$chkValue,$ParametersSetArray);

    	return view('welcome')
                ->with('button',$button);
    }
    public function dotpay(Request $request){
        
        Dotpay::dotpayCheckServer();
        $id = $request->id;
        $status = $request->operation_status;
        $amount = $request->operation_amount;
        $control = $request->control;

        //check is completed
        if(Dotpay::checkCompleted($status,$id,$amount,$control))
        {
            //$t = new Transakcje();
            //$t->id_transakcji = $id;
            //$t->amount = $amount;
            //$t->control = $control;
            //$t->save();
            
            //must be at the end of
            echo 'OK';
        }
    }
    public function end(Request $request){
    	if($request->status == 'OK')
    	{
    		return 'SUCCESS';
    	}
    	else{
    		return 'FAIL';
    	}
    }

}
</pre>
</div>

Warning ! This is not a 100 % guarantee of security is still in the testing phase .


#License
Gerro/Dotpay is open-sourced software licensed under the MIT license

