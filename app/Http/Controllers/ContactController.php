<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Prepare email data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        // Send email using Laravel's Mail facade
        Mail::send([], [], function ($message) use ($data) {
            $message->to('bshehar2002@gmail.com') // Replace with your email address
                    ->subject('New Contact Form Submission: ' . $data['subject'])
                    ->setBody("
                        <h2>New Contact Form Submission</h2>
                        <p><strong>Name:</strong> {$data['name']}</p>
                        <p><strong>Email:</strong> {$data['email']}</p>
                        <p><strong>Subject:</strong> {$data['subject']}</p>
                        <p><strong>Message:</strong></p>
                        <p>{$data['message']}</p>
                    ", 'text/html');
        });

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
