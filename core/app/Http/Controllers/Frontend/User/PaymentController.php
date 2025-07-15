<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Membership\app\Models\Membership;
use Modules\Membership\app\Models\MembershipHistory;
use Modules\Membership\app\Models\UserMembership;

class PaymentController extends Controller
{

    public function store(Request $request)
    {
        $nowPayment = UserMembership::where('payment_status', 'pending')
            ->where('membership_id', $request->membership_id)
            ->where('user_id', auth()->user()->id)->first();


        if (!$nowPayment) {
            $membership = Membership::find($request->membership_id);

            $nowPayment = new UserMembership();
            $nowPayment->user_id = auth()->user()->id;
            $nowPayment->status = 0;
            $nowPayment->membership_id = (int)$request->membership_id;
            $nowPayment->amount = $membership->price;
            $nowPayment->price = $membership->price;
            $nowPayment->payment_gateway = 'nowpayments';
            $nowPayment->payment_status = 'pending';
            $nowPayment->initial_listing_limit = $membership->listing_limit;
            $nowPayment->initial_gallery_images = $membership->gallery_images;
            $nowPayment->initial_featured_listing = $membership->featured_listing;
            $nowPayment->initial_enquiry_form = $membership->enquiry_form;
            $nowPayment->initial_business_hour = $membership->business_hour;
            $nowPayment->initial_membership_badge = $membership->membership_badge;
            $nowPayment->listing_limit = $membership->listing_limit;
            $nowPayment->gallery_images = $membership->gallery_images;
            $nowPayment->featured_listing = $membership->featured_listing;
            $nowPayment->enquiry_form = $membership->enquiry_form;
            $nowPayment->business_hour = $membership->business_hour;
            $nowPayment->membership_badge = $membership->membership_badge;            
            $nowPayment->save();


            MembershipHistory::create([
                'user_id' => auth()->user()->id,
                'membership_id' => $request->membership_id,
                'payment_status' => 'pending',
                'status' => 0,
                'expire_date' => null,
                'payment_gateway' => 'Now Payments',
                'amount' => $membership->price,
                'price' => $membership->price,
                'initial_listing_limit' => $membership->listing_limit,
                'initial_gallery_images' => $membership->gallery_images,
                'initial_featured_listing' => $membership->featured_listing,
                'initial_enquiry_form' => $membership->enquiry_form,
                'initial_business_hour' => $membership->business_hour,
                'initial_membership_badge' => $membership->membership_badge,
                'listing_limit' => $membership->listing_limit,
                'gallery_images' => $membership->gallery_images,
                'featured_listing' => $membership->featured_listing,
                'enquiry_form' => $membership->enquiry_form,
                'business_hour' => $membership->business_hour,
                'membership_badge' => $membership->membership_badge                
            ]);

            $response = Http::withHeaders([
                'x-api-key' => config('app.nowpayment_api_key'),
                'Content-Type' => 'application/json',
            ])->post(config('app.nowpayment_api_url'), [
                'price_amount' => $membership->price, // Monto a pagar
                'price_currency' => 'usd', // Monto expresado en USD
                'pay_currency' => 'btc', // Moneda de pago: Bitcoin
                'ipn_callback_url' => config('app.nowpayment_ipn_callback_url'),
                'order_id' => $nowPayment->id,
                'order_description' => "Pago con Bitcoin del usuario con ID " . auth()->user()->id,
            ]);
            if ($response->successful()) {
                $nowPayment->amount = $response['pay_amount'];
                $nowPayment->pay_address = $response['pay_address'];
                $nowPayment->save();
            }
        }
        return response()->json(['success' => ['pay_address' => $nowPayment->pay_address, 'pay_amount' => $nowPayment->amount], 200]);
    }
}
