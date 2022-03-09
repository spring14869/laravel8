<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SigninController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show(Request $request)
    {
        $data = [];

        return $this->view('web/index', $data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'account' => 'required',
            'password' => 'required|min:6|max:32',
        ]);

        try {
            $post = $request->post();

            $user = $this->user
                ->where('u_account', $post['account'])
                ->first();

            if (!$user) {
                throw new \Exception('account not exist');
            }

            if (!Hash::check($post['password'], $user->u_password)) {
                throw new \Exception('password 錯誤');
            }

            if ($user->u_status != 1) {
                throw new \Exception('user not available');
            }

            $token = $this->createToken($user->u_account);

            $user->remember_token = $token;
            $user->save();

            $this->setLoginSession($user->u_account, $user->u_name, $token);

        } catch (\Exception $exception) {
            return back()->withInput()->with('error', '登入失敗：' . $exception->getMessage());
        }

        return redirect('/user')->with('success', '登入成功');
    }


    public function logout()
    {
        $this->destroySession();

        return redirect('/')->with('success', '登出成功');
    }
}
