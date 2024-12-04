<?php



if (!function_exists('getUserProfileImage')) {
    function getUserProfileImage() {
        $user = auth()->user();

        if ($user && $user->image) {
            return asset('storage/profile/profile_images/' . $user->image);
        } else {
            return asset('images/default-profile-image.jpg'); // Path to your default profile image
        }
    }
}

