<?php

namespace App\Http\Controllers;

use App\Mail\ThesisInvitationMail;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ThesisInvitationController extends Controller
{
    public function send(string $id)
    {
        $thesis = Thesis::with('student.user', 'examiners.lecturer.user')->findOrFail($id);

        if ($thesis->invitation_email_sent) {
            return back()->with('error', 'Invitation email already sent');
        }

        foreach ($thesis->examiners as $examiner) {
            Mail::to($examiner->lecturer->user->email)
                ->send(
                    new ThesisInvitationMail(
                        $thesis,
                        $examiner
                    )
                );
        }
        $thesis->update([
            'invitation_email_sent' => true,
            'invitation_email_sent_at' => now(),
        ]);
        return back()->with(
            'success',
            'Invitation email sent successfully'
        );
    }
}
