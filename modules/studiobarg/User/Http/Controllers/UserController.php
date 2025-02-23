<?php

namespace studiobarg\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Responses\AjaxResponses;
use studiobarg\RolePermission\Repositories\RoleRepo;
use studiobarg\User\Http\Requests\AddRoleRequest;
use studiobarg\User\Http\Requests\UpdateProfileInformationRequest;
use studiobarg\User\Http\Requests\UpdateUserRequest;
use studiobarg\User\Models\User;
use studiobarg\User\Repositories\UserRepo;

class UserController extends Controller
{
    use AuthorizesRequests;
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index(RoleRepo $roleRepo)
    {
        $this->authorize('index', User::class);
        $users = $this->userRepo->paginate();
        $roles = $roleRepo->all();

        return view('User::Admin.index', compact('users', 'roles'));
    } //End METHOD


    public function info($user, UserRepo $repo)
    {
        //$this->authorize('index', User::class);
        $user = $repo->FindByIdFullInfo($user);

        return view('User::Admin.info', compact('user'));
    } //End METHOD


    public function edit($userId, RoleRepo $roleRepo)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);
        $roles = $roleRepo->all();

        return view('User::Admin.edit', compact('user', 'roles'));
    } //End METHOD


    public function update(UpdateUserRequest $request, $userId)
    {
        //$this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);

        if ($request->hasFile('profile-img')) {

            if ($request->file('profile-img')->isValid()) {
                // حذف تصویر قبلی از کالکشن 'images'
                $user->clearMediaCollection('profile');

                // افزودن تصویر جدید به کالکشن 'images'
                $user->addMedia($request->file('profile-img'))
                    ->toMediaCollection('profile');


                $thumbUrl = $user->getFirstMediaUrl('images', 'thumb');
                $previewUrl = $user->getFirstMediaUrl('images', 'preview');
            } else {
                return back()->withErrors(['profile-img' => 'The uploaded file is invalid or not found']);
            }
        }

        $this->userRepo->update($userId, $request);
        //newFeedback();

        return redirect()->back();
    } //End METHOD


    public function profile()
    {
        //$this->authorize('editProfile', User::class);

        return view('User::admin.profile');
    } //End METHOD

    public function updateProfile(UpdateProfileInformationRequest $request)
    {
        //$this->authorize('editProfile', User::class);
        $this->userRepo->updateProfile($request);
        newFeedback();

        return back();

    }

    public function destroy($userId)
    {
        $user = $this->userRepo->findById($userId);
        $user->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();

        return AjaxResponses::SuccessResponse();
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        //newFeedback('موفقیت آمیز', " نقش کاربری {$request->role}  به کاربر {$user->name} داده شد.", 'success');

        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);
        $user = $this->userRepo->findById($userId);
        $user->removeRole($role);

        return AjaxResponses::SuccessResponse();
    }
}
