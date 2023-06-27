<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuController extends Controller
{
    /**
     * 支払い方法の選択画面を表示する関数
     * @param Request
     * @return view
     */
    public function index(Request $request)
    {
        // debug_mode (本来は、Requestから取得)
        $seats_info = [
            ['area' => 'E', 'type' => 'レギュラーシート', 'row' => '9', 'num' => '74'],
            ['area' => 'E', 'type' => '車いすシート',    'row' => '',  'num' => '1'],
            ['area' => 'E', 'type' => 'BOXシート',      'row' => '',  'num' => '1'],
            ['area' => '',  'type' => 'VIPルーム',      'row' => '',  'num' => '1903'],
        ];
        $hold_info = [
            'date'            => '2023-05-16',
            'day_or_night'    => 'day',
            'open_venue_time' => '11:00',
            'start_show_time' => '12:00',
            'season'          => '20-21 オータムシーズン',
            'round'           => '1',
            'game_type'       => '予選〜準々決勝',
        ];
        $amount = '100';

        $seats = self::arrangeSeats($seats_info);
        $hold  = self::arrangeHold($hold_info);
        // dd($hold);

        return view('payment.menu.index', compact('seats', 'hold', 'amount'));
    }
    
    /**
     * 座席情報を表示用に整形する関数
     * @param array $seats_info
     * @return array $sets
     */
    private static function arrangeSeats($seats_info)
    {
        foreach ($seats_info as $seat) {
            
            if ( $seat['type'] === 'レギュラーシート' ) {
                $seats[] = $seat['area'] . ' ' . $seat['type'] . ' ' . $seat['row'] . '列 ' . $seat['num'] . '番';

            } elseif ( $seat['type'] === '車いすシート' ) {
                $seats[] = $seat['area'] . ' ' . $seat['type'] . ' ' . $seat['num'] . '番';

            } elseif ( $seat['type'] === 'BOXシート' ) {
                $seats[] = $seat['area'] . ' ' . $seat['type'] . ' ' . $seat['num'] . '番';

            } elseif ( $seat['type'] === 'VIPルーム' ) {
                $seats[] = $seat['type'] . ' ' . $seat['num'];

            }
        }

        return $seats;
    }

    /**
     * 開催情報を表示ように整形する関数
     * @param  array $hold_info
     * @return array $hold
     */
    private static function arrangeHold($hold_info)
    {
        // 開催日
        $week = ['日', '月', '火', '水', '木', '金', '土'];
        $dt = new Carbon($hold_info['date']);
        $hold['date'] = $dt->month . '.' . $dt->day;
        $hold['week'] = $week[$dt->dayOfWeek];
        
        // その他
        foreach ($hold_info as $key => $val) {
            if ( $key === 'date' ) {
                continue;
            } else {
                $hold[$key] = $val;
            }
        }

        return $hold;
    }
}
