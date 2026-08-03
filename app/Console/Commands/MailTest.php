<?php

namespace App\Console\Commands;

use App\Mail\DermatologistApprovedMail;
use App\Models\Dermatologist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Delivery check for the approval email.
 *
 * "It arrives in my own inbox but nowhere else" is almost always a From/SMTP
 * mismatch, a non-sending mailer (log/array), or spam filtering — none of which
 * show up in the admin UI. This command prints the effective settings, flags
 * those traps, then sends the real message and reports the raw mail-server
 * response.
 */
class MailTest extends Command
{
    protected $signature = 'mail:test
                            {email : Address the test message is delivered to}
                            {--dermatologist= : Use this dermatologist id for the mail body (default: newest)}';

    protected $description = 'Send the dermatologist approval email to any address and report what the mail server said';

    public function handle(): int
    {
        $to       = (string) $this->argument('email');
        $mailer   = (string) config('mail.default');
        $smtpUser = (string) config("mail.mailers.{$mailer}.username");
        $from     = (string) config('mail.from.address');

        $this->newLine();
        $this->line("  Mailer     : <fg=cyan>{$mailer}</>");
        $this->line('  Host       : <fg=cyan>' . config("mail.mailers.{$mailer}.host") . ':' . config("mail.mailers.{$mailer}.port") . '</>');
        $this->line('  Encryption : <fg=cyan>' . (config("mail.mailers.{$mailer}.encryption") ?: 'none') . '</>');
        $this->line('  SMTP user  : <fg=cyan>' . ($smtpUser ?: '<none>') . '</>');
        $this->line('  From       : <fg=cyan>' . $from . '</> (' . config('mail.from.name') . ')');
        $this->line("  Recipient  : <fg=cyan>{$to}</>");
        $this->newLine();

        if (in_array($mailer, ['log', 'array'], true)) {
            $this->warn("  MAIL_MAILER={$mailer} never delivers to a real inbox. Set MAIL_MAILER=smtp in .env.");
            $this->newLine();
        }

        if ($smtpUser !== '' && strcasecmp($from, $smtpUser) !== 0) {
            $this->warn("  MAIL_FROM_ADDRESS ({$from}) is not the authenticated mailbox ({$smtpUser}).");
            $this->warn('  Providers like Gmail reject or spam-fold that, which is exactly how mail');
            $this->warn('  reaches your own inbox but no one else. Make the two match.');
            $this->newLine();
        }

        if (str_contains($from, 'example.com')) {
            $this->warn("  MAIL_FROM_ADDRESS is still the Laravel placeholder ({$from}).");
            $this->newLine();
        }

        try {
            $mailable = $this->buildMailable();
        } catch (\Throwable $e) {
            $this->error('  Could not load a dermatologist for the mail body: ' . $e->getMessage());

            return self::FAILURE;
        }

        try {
            if ($mailable instanceof DermatologistApprovedMail) {
                Mail::to($to)->send($mailable);
            } else {
                Mail::raw($mailable, fn ($message) => $message->to($to)->subject('DermaConnect mail delivery test'));
            }
        } catch (\Throwable $e) {
            $this->error('  FAILED: ' . get_class($e));
            $this->line('  ' . $e->getMessage());
            $this->newLine();

            return self::FAILURE;
        }

        $this->info("  Handed to the mail server for {$to} without error.");
        $this->line('  If it does not arrive, check that inbox\'s Spam/Junk folder — the message');
        $this->line('  left this application successfully, so the rest is filtering on their side.');
        $this->newLine();

        return self::SUCCESS;
    }

    /**
     * The real approval mailable when a dermatologist is reachable, otherwise a
     * plain-text probe so the command still works with the database down.
     */
    protected function buildMailable(): DermatologistApprovedMail|string
    {
        $id = $this->option('dermatologist');

        try {
            $dermatologist = $id
                ? Dermatologist::with('user')->find($id)
                : Dermatologist::with('user')->latest('id')->first();
        } catch (\Throwable $e) {
            $this->warn('  Database unreachable — sending a plain-text probe instead of the approval mail.');
            $this->newLine();

            return 'DermaConnect mail delivery test. If you can read this, SMTP delivery works.';
        }

        if ($id && ! $dermatologist) {
            throw new \RuntimeException("no dermatologist with id {$id}");
        }

        if (! $dermatologist) {
            $this->warn('  No dermatologists in the database — sending a plain-text probe instead.');
            $this->newLine();

            return 'DermaConnect mail delivery test. If you can read this, SMTP delivery works.';
        }

        $this->line("  Body       : approval mail for dermatologist #{$dermatologist->id}");
        $this->newLine();

        return new DermatologistApprovedMail($dermatologist);
    }
}
