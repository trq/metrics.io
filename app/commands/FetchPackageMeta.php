<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Guzzle\Http\Client;

class FetchPackageMeta extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'fetch:meta';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetches package meta data from packagist.';

    /**
     * API host.
     */
    protected $host = 'http://packagist.org';

	/**
	 * The location to store the meta data.
	 *
	 * @var string
	 */
    protected $location;

    /**
     * Setup our command object
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
        $number_of_packages = $this->option('packages');
        $pages = ceil($number_of_packages / 15);

        foreach (range(1, $pages) as $page) {
            $client   = new Client($this->host);
            $request  = $client->get("/search.json?page={$page}&q=");
            $response = $request->send();
            $json     = $response->getBody();

            $data = json_decode($json);

            for ($i = 0; $i < $number_of_packages; $i++) {
                if (isset($data->results[$i])) {
                    $package = $data->results[$i];
                    $this->getPackage($package->name);
                }
            }
        }
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('packages', null, InputOption::VALUE_OPTIONAL, 'The number of packages to retrieve. This will fetch this number of packages + all of there dependencies.', 20),
		);
	}

    protected function getPackage($package) {
        list($basename, $name) = explode('/', $package);

        if (!file_exists("{$this->location}/{$basename}/{$name}.json")) {
            $this->info("Fetching: {$name}");
            try {
                $client      = new Client($this->host);
                $request     = $client->get("/packages/{$basename}/{$name}.json");
                $response    = $request->send();
                $body        = $response->getBody();
                $json        = json_decode($body);

                // deal with dependencies
                foreach ($json as $package) {
                    foreach ($package->versions as $version) {
                        if (property_exists($version, 'require')) {
                            foreach ($version->require as $dependency => $v) {
                                if (strpos($dependency, '/') !== false) {
                                    $this->getPackage($dependency);
                                }
                            }
                        }
                    }
                }

                if (!file_exists("{$this->location}/{$basename}")) {
                    mkdir("{$this->location}/{$basename}");
                }

                $this->info("Writting: {$this->location}/$basename/$name.json");
                file_put_contents("{$this->location}/{$basename}/{$name}.json", $body);

            } catch (Exception $e) {
                $this->error("Failed to fetch: {$name}");
                //$this->error($e->getMessage());
            }
        }
    }
}
