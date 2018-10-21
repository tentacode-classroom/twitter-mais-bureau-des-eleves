<?php
namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class CommandInstall extends Command
{
    protected static $defaultName = 'app:install';

    protected function configure()
    {
        $this
            ->setName('app:install')
            ->setDescription('Command to install the project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Installation of the project');
        $io->progressStart(11);
        $io->newLine(4);
        $io->section('Installation of composer dependencies');
        $process = new Process('composer install');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Setup file config (.env)');
        $dbname = $io->ask('What is your database username ?', 'db_user', function ($dbname) {
            if (empty($dbname)) {
                throw new \RuntimeException('User cannot be empty.');
            }
            return $dbname;
        });
        $process = new Process('replace "db_user" "' . $dbname . '" -- .env');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $dbpassword = $io->askhidden('What is your database password ?', function ($dbpassword) {
            if (empty($dbpassword)) {
                throw new \RuntimeException('Password cannot be empty.');
            }
            return $dbpassword;
        });
        $process = new Process('replace "db_password" "' . $dbpassword . '" -- .env');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Launch MySQL server');
        $process = new Process('mysql.server start');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Create DataBase');
        $process = new Process('bin/console doctrine:database:create --if-not-exists');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Init DataBase');
        $process = new Process('bin/console app:mig');
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Run the server');
        $process = new Process('php bin/console server:start');
        // $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> ' . $buffer);
        });
        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressFinish();
        $io->newLine(20);
        $io->newLine(2);
        $io->success('Yeah ! The project is installed ! You can check it out in your favourite web browser :D');
    }
}