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
        if (file_exists($this->location . "/list.txt")) {
            unlink($this->location . "/list.txt");
        }

        foreach (range(1, $this->option('pages')) as $page) {
            $client   = new Client($this->host);
            $request  = $client->get("/search.json?page={$page}&q=");
            $response = $request->send();
            $json     = $response->getBody();

            $data = json_decode($json);

            foreach ($data->results as $package) {

                if (!file_exists($this->location . "/" . str_replace('/', '-', $package->name) . '.json')) {
                    $this->info("Fetching: {$package->name}");
                    try {
                        $client      = new Client($this->host);
                        $request     = $client->get("/packages/{$package->name}.json");
                        $response    = $request->send();
                        $json        = $response->getBody();

                        file_put_contents($this->location . "/list.txt", "{$package->name}\n", FILE_APPEND);
                        file_put_contents($this->location . "/" . str_replace('/', '-', $package->name) . '.json', $json);
                    } catch (Exception $e) {
                        $this->error("Failed to fetch: {$package->name}");
                    }
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
			array('pages', null, InputOption::VALUE_OPTIONAL, 'The number of pages to retrieve. Each page contains 15 packages.', 4),
		);
	}

}
