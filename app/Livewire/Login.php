<?php

namespace App\Livewire;

use App\Mail\LoginLink;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use MagicLink\Actions\LoginAction;
use MagicLink\MagicLink;

class Login extends Component
{
    public string $email;
    public string $error   = '';
    public string $success = '';

    public function mount()
    {
        if (Auth::guard('subjects')->check()) {
            return redirect()->route('test-list');
        }
    }

    public function submit()
    {
        $subject = Subject::where('email', $this->email)->first();
        if (blank($subject)) {
            $this->error = 'Cette adresse email n\'existe pas dans notre base de données de participants.';
        } else {
            $action = new LoginAction($subject);
            $action->guard('subjects');
            $action->remember();

            $url = MagicLink::create($action, 60, 1)->url; // 60 minutes, single use
            Mail::to($subject->email)->send(new LoginLink($url));

            $this->error = '';
            $this->success = 'Un lien de connexion vient de vous être envoyé à l\'adresse indiquée.';
            $this->email = '';
        }
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.login');
    }
}
