<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteAdmin extends Command
{
    protected $signature = 'user:promote-admin {email}';
    protected $description = 'Promote a user to admin role';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("ไม่พบผู้ใช้ email: {$email}");
            return Command::FAILURE;
        }

        $user->update(['role' => 'admin', 'is_active' => true]);
        $this->info("✅ เปลี่ยน {$user->name} ({$email}) เป็น admin เรียบร้อย");

        return Command::SUCCESS;
    }
}
