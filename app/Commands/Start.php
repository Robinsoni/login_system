<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Start extends BaseCommand
{
    
        /**
         * Group
         *
         * @var string
         */
        protected $group = 'App';
    
        /**
         * Name
         *
         * @var string
         */
        protected $name = 'start';
    
        /**
         * Description
         *
         * @var string
         */
        protected $description = 'Launches the CodeIgniter PHP-Development Server on port 1010.';
    
        /**
         * Usage
         *
         * @var string
         */
        protected $usage = 'start';
    
        /**
         * Arguments
         *
         * @var array<string, string>
         */
        protected $arguments = [];
    
        /**
         * The current port offset.
         *
         * @var int
         */
        protected $portOffset = 0;
    
        /**
         * The max number of ports to attempt to serve from
         *
         * @var int
         */
        protected $tries = 10;
    
        /**
         * Options
         *
         * @var array<string, string>
         */
        protected $options = [
            '--php'  => 'The PHP Binary [default: "PHP_BINARY"]',
            '--host' => 'The HTTP Host [default: "localhost"]',
            '--port' => 'The HTTP Host Port [default: "1010"]',
        ];
    
        /**
         * Run the server
         */
        public function run(array $params)
        {
            // Collect any user-supplied options and apply them.
            $php  = escapeshellarg(CLI::getOption('php') ?? PHP_BINARY);
            $host = CLI::getOption('host') ?? 'localhost';
            $port = (int) (CLI::getOption('port') ?? 1010) + $this->portOffset;
    
            // Get the party started.
            CLI::write('CodeIgniter development server started on http://' . $host . ':' . $port, 'green');
            CLI::write('Press Control-C to stop.');
    
            // Set the Front Controller path as Document Root.
            $docroot = escapeshellarg(FCPATH);
    
            // Mimic Apache's mod_rewrite functionality with user settings.
            $rewrite = escapeshellarg(__DIR__ . '/rewrite.php');
    
            // Call PHP's built-in webserver, making sure to set our
            // base path to the public folder, and to use the rewrite file
            // to ensure our environment is set and it simulates basic mod_rewrite.
            passthru($php . ' -S ' . $host . ':' . $port . ' -t ' . $docroot . ' ' . $rewrite, $status);
    
            if ($status && $this->portOffset < $this->tries) {
                $this->portOffset++;
    
                $this->run($params);
            }
        }
}
