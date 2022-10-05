<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class notificacionController extends Controller
{
    public function index() {
        $user = User::find(Auth::user()->id);
        $notificacionesSinLeer = $user->unreadNotifications()->get();
        $notificacionesleidas = $user->readNotifications()->get();
        
        return view('notificaciones.index',compact('notificacionesSinLeer','notificacionesleidas'));
    }

    public function marcarTodasLeidas() {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
