<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    } //public function viewAny(User $user)

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        if($user->userHasRole('admin')) {
            return true;
        } //if($user->userHasRole('admin')) {
        elseif($user->userHasRole('manager')) {
            return true;
        } //elseif($user->userHasRole('manager')) {
        else {
            return $user->id == $model->id;
        } //esle
    } //public function view(User $user, User $model)

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->is($user);
    } //public function create(User $user)

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        if($user->userHasRole('admin')) {
            return true;
        } //if($user->userHasRole('admin')) {
        elseif($user->userHasRole('manager')) {
            return true;
        } //elseif($user->userHasRole('moderator')) {
        else {
            return $user->id == $model->id;
        } //else
    } //public function update(User $user, User $model)

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        if($user->userHasRole('admin')) {
            return true;
        } //if($user->userHasRole('admin')) {
        elseif($user->userHasRole('manager')) {
            return true;
        } //elseif($user->userHasRole('manager')) {
        else {
            return $user->id == $model->id;
        } //else
    } //public function delete(User $user, User $model)

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    } //public function restore(User $user, User $model)

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    } //public function forceDelete(User $user, User $model)
} //class UserPolicy
