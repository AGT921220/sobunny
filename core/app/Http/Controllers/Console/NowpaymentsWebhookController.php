<?php

namespace App\Http\Controllers\Console;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Membership\app\Models\Membership;
use Modules\Membership\app\Models\MembershipHistory;
use Modules\Membership\app\Models\UserMembership;

class NowpaymentsWebhookController extends Controller
{

    public function index(Request $request)
    {
        info('CustomSearchListingController@index');
        info($request->all());
    }
    public function store(Request $request)
    {
        $status = $request->payment_status;
        $orderId = $request->order_id;
        $userMembership = UserMembership::find($orderId);

        $membershipType = Membership::join('membership_types', 'memberships.membership_type_id', '=', 'membership_types.id')
            ->where('memberships.id', $userMembership->membership_id)
            ->first();

        $validity = $membershipType->validity;
        if ($status == 'finished') {
            UserMembership::where('id', '!=', $userMembership->id)
                ->where('user_id', $userMembership->user_id)
                ->delete();
            $userMembership->status = 1;
            $userMembership->payment_status = 'complete';
            $userMembership->expire_date = Carbon::now()->addDays($validity);
            $userMembership->save();
            MembershipHistory::where('user_id', $userMembership->user_id)
                ->where('payment_status', 'pending')
                ->update([
                    'status' => 0,
                ]);
            MembershipHistory::where('user_id', $userMembership->user_id)
                ->where('payment_status', 'pending')
                ->update([
                    'payment_status' => 'complete',
                    'status' => 1,
                    'expire_date' => Carbon::now()->addDays($validity)
                ]);
        }
    }
}
