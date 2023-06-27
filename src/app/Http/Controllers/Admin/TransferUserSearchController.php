<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Admin\Download;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransferUserSearchController extends Controller
{
    protected $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    /**
     * 初期表示
     *
     * @return void
     */
    public function index()
    {
        try {
            $param = $this->getParam(false);
            session()->put('csv_params',$param);
            $users = $this->User->getUserList();
            return view('admin.transferUser.search', compact('users', 'param'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user_search.list'));
        }
    }

    /**
     * 検索
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        try {
            $param = $this->getParam(true, $request);
             if(empty($param)){
                $param = $request->session()->get('csv_params');
             }
             $request->session()->put('csv_params',$param);
            $users = $this->User->getUserListBySearch($param)->orderBy('id')->paginate(config('admin.common.pagination'));
            return view('admin.transferUser.search', compact('users', 'param'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user_search.search'));
        }
    }

    /**
     * CSVダウンロード
     *
     * @return void
     */
    public function download(Request $request)
    {
        try {
            $param = $request->session()->get('csv_params');
            $Download = new Download();
            return $Download->download($param);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            exit(config('admin.message.error.transfer_user_search.download'));
        }
    }

    /**
     * viewで使用する各パラメータ設定
     *
     * @param boolean $search_flg
     * @param object $request
     * @return array
     */
    private function getParam($search_flg, $request = null)
    {
        if ($search_flg) {
            return $request->only([
                'id'
                , 'name'
                , 'name_kana'
                , 'year'
                , 'month'
                , 'day'
                , 'email'
                , 'zip_code'
                , 'phone_number'
                , 'transfer_flg'
            ]);
        } else {
            return [
                'id' => ''
                , 'name' => ''
                , 'name_kana' => ''
                , 'year' => ''
                , 'month' => ''
                , 'day' => ''
                , 'email' => ''
                , 'zip_code' => ''
                , 'phone_number' => ''
                , 'transfer_flg' => ''
            ];
        }
    }
}
