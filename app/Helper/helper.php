<?php
use Illuminate\Support\Facades\Auth;

/* Check the loging user have access or not for particular module */
if (!function_exists('hasViewAccess')) {
    function hasViewAccess($module)
    {
        try {
            $user = Auth::user();
            $permission = '';
            if($module && $user){
                $permission = "can-view-$module";
            }
            return $user->hasPermissionTo($permission);
        } catch (\Exception $e) {
            \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }
    }
}