<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SiteSetting;

class PageController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:120',
            'message' => 'required|string|max:2000',
        ]);

        // Pull the contact email from site settings (Member 1's admin panel)
        // Falls back to a safe default if it's not set
        $toEmail = SiteSetting::get('contact_email', 'hello@melodix.local');

        try {
            Mail::raw(
                "New Contact Form Submission\n\n" .
                "Name: {$request->name}\n" .
                "Email: {$request->email}\n\n" .
                "Message:\n{$request->message}",
                function ($message) use ($toEmail) {
                    $message->to($toEmail)
                            ->subject('New Contact Form Submission - Melodix');
                }
            );

            return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
        } catch (\Exception $e) {
            // Log the error for debugging but show a user-friendly message
            \Log::error('Contact form failed: ' . $e->getMessage());
            return back()->with('error', 'We could not send your message right now. Please try again later.');
        }
    }

    public function helpCenter()
    {
        return view('pages.help');
    }

    public function privacyPolicy()
    {
        return view('pages.privacy');
    }

    public function termsOfUse()
    {
        return view('pages.terms');
    }
}