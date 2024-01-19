<?php

namespace App\Livewire;

use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email;
    public string $error   = '';
    public string $success = '';

    public function submit()
    {
        $subject = Subject::where('email', $this->email)->first();
        if (blank($subject)) {
            $this->error = 'Cette adresse email n\'existe pas dans notre base de données de participants.';
        } else {
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
