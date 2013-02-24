<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportDevelopers extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'import:developers';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import Developers from package meta data.';

    protected $location;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

        $this->location = app_path() . '/storage/package-meta';
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
	    foreach (glob($this->location . '/*/*.json') as $package_meta) {
            $meta = json_decode(file_get_contents($package_meta));
            foreach ($meta as $package) {
                if (property_exists($package, 'maintainers')) {
                    foreach ($package->maintainers as $developer) {
                        // We have unique keys on this table to prevent duplicates.
                        try {
                            $d = new Developer;
                            $d->name = $developer->name;
                            $d->email = $developer->email;
                            $d->save();
                            $this->info("Adding: {$developer->name} {$developer->email}");
                        // Ignore any failures.
                        } catch (Exception $e) {}
                    }

                    // Loop into different versions of the package.
                    if (property_exists($package, 'versions')) {
                        foreach ($package->versions as $version) {
                            if (property_exists($version, 'authors')) {
                                foreach ($version->authors as $developer) {
                                    // We have unique keys on this table to prevent duplicates.
                                    try {
                                        $d = new Developer;
                                        $d->name = $developer->name;
                                        $d->email = $developer->email;
                                        $d->save();
                                        $this->info("Adding: {$developer->name} {$developer->email}");
                                    // Ignore any failures.
                                    } catch (Exception $e) {}
                                }
                            }
                        }
                    }
                }
            }
        }
	}
}
