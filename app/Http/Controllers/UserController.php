<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * Instantiate the user repository.
     * 
     * @param \App\Repositories\Eloquent\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @var    Collection $user
     * @return \Illuminate\View
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return View::make('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View
     */
    public function create()
    {
        return View::make('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @var    \App\models\User $user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request);
        
        return redirect()
            ->route('user.show', compact('user'))
            ->with('message', 'User succesfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View
     */
    public function show(User $user)
    {
        return View::make('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View
     */
    public function edit(User $user)
    {
        return View::make('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\UpdateUserRequest $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);
        
        return redirect()
            ->route('user.show', compact('user'))
            ->with('message', 'User succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->userRepository->destroy($user->id);

        return redirect()
            ->route('user.index')
            ->with('message', 'User succesfully deleted.');
    }
}
