<?php

namespace App\Mail;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    protected $membership;
    protected $sender;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Membership $membership, User $sender, $url)
    {
        $this->membership = $membership;
        $this->sender = $sender;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.user.invitation')
                    ->with([
                        'membership' => $this->membership,
                        'user' => $this->membership->user,
                        'company' => $this->membership->company,
                        'sender' => $this->sender,
                        'url' => $this->url,
                    ]);
    }
}
