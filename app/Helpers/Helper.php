<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\InstanceUser;
use App\Models\OrderAction;

class Helper
{
    public static function phoneFormat(string $phone): string
    {
        $ac = substr($phone, 0, 2);
        $prefix = substr($phone, 2, 3);
        $suffix1 = substr($phone, 3, 2);
        $suffix2 = substr($phone, 5,2);

        return "(".$ac.") ".$prefix." - ".$suffix1." - ".$suffix2;
    }


    public static function businessHours(string $start, string $end):string
    {
        $startDate = strtotime(date('Y-m-d', strtotime($start)));
        $endDate = strtotime(date('Y-m-d', strtotime($end)));

        $start_working_hour = strtotime(env('START_WORKING_HOUR'));
        $start_dinner_hour = strtotime(env('START_DINNER_HOUR'));
        $end_dinner_hour = strtotime(ENV('END_DINNER_HOUR'));
        $end_working_hour = strtotime(ENV('END_WORKING_HOUR'));

        return '1';
    }


    public static function checkOrderActionComment(array $order): bool
    {
        $userId = Auth::id();
        if($userId == $order['userId']) {
            return false;
        }

        $instanceId = InstanceUser::where('userId', $userId)->first()?->instanceId;
        if(OrderAction::where(['orderId' => $order['id'], 'instanceId' => $instanceId])->latest()->exists()) {
            return false;
        }
        return  true;
    }


    public static function canCreateOrderBtn(): bool
    {
        return Auth::user()->roadId && Auth::user()->instanceId && Auth::user()->canCreateOrder;
    }

}
