<?php

namespace App\Policies;

use App\User;
Use App\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExportPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function export(User $user, Contact $contact) {
        return $user->id == $contact->user_id;
    }

}
