<?php

namespace Pterodactyl\Http\Controllers\Server;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Traits\Controllers\JavascriptInjection;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class ListController extends Controller
{
    use JavascriptInjection;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * ConsoleController constructor.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(ConfigRepository $config)
    {
        $this->config = $config;
    }

    /**
     * Render server index page with the console and power options.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function view(Request $request): View
    {
        $server = $request->attributes->get('server');

        $this->setRequest($request)->injectJavascript([
            'server' => [
                'cpu' => $server->cpu,
            ],
            'meta' => [
                'saveFile' => route('server.files.save', $server->uuidShort),
                'csrfToken' => csrf_token(),
            ],
            'config' => [
                'console_count' => $this->config->get('pterodactyl.console.count'),
                'console_freq' => $this->config->get('pterodactyl.console.frequency'),
            ],
        ]);
		if (isset($_GET['pageno'])) {
			$pageno = $_GET['pageno'];
			} else {
				$pageno = 1;
				}
		$no_of_records_per_page = 15;
		$offset = ($pageno-1) * $no_of_records_per_page;
		$players = [];
		$i = 1;

        if($server->nest_id === 4 || $server->nest_id === 2){
		require $_SERVER['DOCUMENT_ROOT'].'/query/bootstrap.php';
        $Query = new \xPaw\SourceQuery\SourceQuery();

	        try{
				$Query->Connect( $server->allocation->ip, $server->allocation->port, 1, \xPaw\SourceQuery\SourceQuery::SOURCE );
				$players = $Query->GetPlayers();
				$info = $Query->GetInfo();
				
				$total_rows = $info['Players'];
				$total_pages = ceil($total_rows / $no_of_records_per_page);
	            }
			catch( \Exception $e ){
                 $total_pages = 1;
		        }
		    finally{
		        $Query->Disconnect();
		        }
		}
					
        return view('server.playerlist.index', ['players' => $players, 'pageno' => $pageno, 'i' => $i, 'no_of_records_per_page' => $no_of_records_per_page, 'offset' => $offset, 'total_pages' => $total_pages]);
    }

}
