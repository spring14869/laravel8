<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = 10;

        $users = $this->user->with('status')->simplePaginate($pageSize);

        $data = [
            'users' => $users
        ];

        return $this->view('web/user/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->user->getDefaultValue();

        $data = [
            'title' => 'Add user',
            'user' => $user,
            'route' => route('user.store')
        ];

        return $this->view('web/user/edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'u_account' => 'required',
            'u_password' => 'required|min:6|max:32',
            'u_name' => 'required',
        ]);

        $post = $request->post();

        try {
            $imagePath = $this->resizeImage(
                $this->uploadFile($request->file('u_image'), 'user_' . time())
            );

            $rs = $this->user->create(
                [
                    'u_account' => trim($post['u_account']),
                    'u_password' => trim(Hash::make($post['u_password'])),
                    'u_name' => trim($post['u_name']),
                    'u_email' => trim($post['u_email']),
                    'u_status' => isset($post['u_status']) ? $post['u_status'] : 0,
                    'u_image' => $imagePath
                ]
            );

            if (!$rs) {
                throw new \Exception('新增失敗');
            }
        } catch (\Exception $exception) {
            return back()->withInput()->with('error', '新增失敗：' . $exception->getMessage());
        }

        return redirect('/user')->with('success', '新增成功');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->where('u_id', $id)->first()->toArray();

        $data = [
            'title' => 'Edit user',
            'user' => $user,
            'route' => route('user.update', $id),
            'deleteRoute' => route('user.destroy', $id),
        ];

        return $this->view('web/user/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'u_password' => 'required_if:u_password,not nullable',
            'u_name' => 'required'
        ]);

        try {
            $patch = $request->all();

            $imagePath = $this->resizeImage(
                $this->uploadFile($request->file('u_image'), 'user_' . $id)
            );

            $update = [
                'u_name' => trim($patch['u_name']),
                'u_email' => trim($patch['u_email']),
                'u_status' => isset($patch['u_status']) ? $patch['u_status'] : 0,
            ];
            if (!empty($patch['u_password'])) {
                $update['u_password'] = trim(Hash::make($patch['u_password']));
            }
            if (!empty($imagePath)) {
                $update['u_image'] = trim($imagePath);
            }

            $rs = $this->user
                ->where('u_id', $id)
                ->update($update);

            if (!$rs) {
                throw new \Exception('更新失敗');
            }

        } catch (\Exception $exception) {
            return back()->withInput()->with('error', '更新失敗：' . $exception->getMessage());
        }

        return redirect('/user')->with('success', '更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($id == 1) {
                throw new \Exception('無法刪除root user');
            }

            $user = $this->user->findOrFail($id);

            if (!$user->delete()) {
                throw new \Exception('無法刪除');
            }
        } catch (\Exception $exception) {
            return back()->withInput()->with('error', '刪除失敗：' . $exception->getMessage());
        }

        return redirect('/user')->with('success', '刪除成功');
    }
}
