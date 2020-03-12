<?php

namespace OneStop\Policies;

use OneStop\User;
use OneStop\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cart.
     *
     * @param  \OneStop\User  $user
     * @param  \OneStop\Cart  $cart
     * @return mixed
     */
    public function view(User $user, Cart $cart)
    {
        //
    }

    /**
     * Determine whether the user can create carts.
     *
     * @param  \OneStop\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cart.
     *
     * @param  \OneStop\User  $user
     * @param  \OneStop\Cart  $cart
     * @return mixed
     */
    public function update(User $user, Cart $cart)
    {
        //
    }

    /**
     * Determine whether the user can delete the cart.
     *
     * @param  \OneStop\User  $user
     * @param  \OneStop\Cart  $cart
     * @return mixed
     */
    public function delete(User $user, Cart $cart)
    {
        //
    }
}
