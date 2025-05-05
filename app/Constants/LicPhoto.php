<?php

namespace App\Constants;

class LicPhoto
{

    // the code down here is used in RegisteredUserController for storing the license photo
    // so from the path i can get the license photo based on the url , so i can use it in the view
    // to verify the license photo
    // $licensePath = null;
    // if ($request->hasFile('ins_lic_photo')) {
    //     $licensePath = $request->file('ins_lic_photo')->store('licenses', 'public');
    // }
    //
    const AdminRole = 0;
    const InstituteRole = 1;
    const UserRole = 2;

}
