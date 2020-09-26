<?php

namespace App\Http\Controllers;

use App\Facade\PayPal;
use App\Mail\SendmailPurchase;
use App\Product;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index',compact('products'));
    }
    public function singleProduct ($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.singleProduct', compact('product'));
    }
    public function executeOrder ($id)
    {
            $product = Product::findOrFail($id);
            $apiContext = PayPal::apiContext();
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $details->setShipping(2.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);

            $amount->setCurrency('USD');
            $amount->setTotal($product->price + 4);
            $amount->setDetails($details);
            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);
            try {
                $result = $payment->execute($execution, $apiContext);
                print("Executed Payment 1".$payment->getId()."Results:". $result);

                try {
                    $payment = Payment::get($paymentId, $apiContext);
                    $paymentInfo = json_decode($payment);
                    Mail::to($paymentInfo->payer->payer_info->email)
                        ->bcc('webshop-admin@personal-blog.test')
                        ->send(new SendmailPurchase($paymentInfo));
                } catch (\Exception $ex) {
                    return redirect(route('shop.index'));
                }
            } catch (\Exception $ex) {
                return redirect(route('shop.index'));
            }
        return redirect(route('shop.index'));


}

    public function OrderProduct($id){
        $product = Product::findOrFail($id);
        $apiContex = PayPal::apiContext();
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName($product->title)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku($product->id) // Similar to `item_number` in Classic API
            ->setPrice($product->price);


        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setShipping(2)
            ->setTax(2)
            ->setSubtotal($product->price);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($product->price)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('shop.executeOrder',$id))
            ->setCancelUrl(route('shop.index'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        $request = clone $payment;
         try {
            $payment->create($apiContext);
        } catch (\Exception $ex) {

            print("Created Payment Using PayPal. Please visit the URL to Approve." .$request);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();
        return redirect($approvalUrl);
    }
}
