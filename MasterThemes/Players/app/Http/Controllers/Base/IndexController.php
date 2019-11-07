<?php

namespace Pterodactyl\Http\Controllers\Base;

use Illuminate\Http\Request;
use Pterodactyl\Models\User;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Pterodactyl\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Pterodactyl\Services\DaemonKeys\DaemonKeyProviderService;
use Pterodactyl\Contracts\Repository\ServerRepositoryInterface;
use Pterodactyl\Contracts\Repository\Daemon\ServerRepositoryInterface as DaemonServerRepositoryInterface;


class IndexController extends Controller
{
    /**
     * @var \Pterodactyl\Contracts\Repository\Daemon\ServerRepositoryInterface
     */
    protected $daemonRepository;

    /**
     * @var \Pterodactyl\Services\DaemonKeys\DaemonKeyProviderService
     */
    protected $keyProviderService;

    /**
     * @var \Pterodactyl\Contracts\Repository\ServerRepositoryInterface
     */
    protected $repository;

    /**
     * IndexController constructor.
     *
     * @param \Pterodactyl\Services\DaemonKeys\DaemonKeyProviderService          $keyProviderService
     * @param \Pterodactyl\Contracts\Repository\Daemon\ServerRepositoryInterface $daemonRepository
     * @param \Pterodactyl\Contracts\Repository\ServerRepositoryInterface        $repository
     */
    public function __construct(
        DaemonKeyProviderService $keyProviderService,
        DaemonServerRepositoryInterface $daemonRepository,
        ServerRepositoryInterface $repository
    ) {
        $this->daemonRepository = $daemonRepository;
        $this->keyProviderService = $keyProviderService;
        $this->repository = $repository;
    }

    /**
     * Returns listing of user's servers.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $servers = $this->repository->setSearchTerm($request->input('query'))->filterUserAccessServers(
            $request->user(), User::FILTER_LEVEL_ALL, config('pterodactyl.paginate.frontend.servers')
        );

        return view('base.index', ['servers' => $servers]);
    }

    /**
     * Returns status of the server in a JSON response used for populating active status list.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $uuid
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function status(Request $request, $uuid)
    {
        $server = $this->repository->findFirstWhere([['uuidShort', '=', $uuid]]);
        $token = $this->keyProviderService->handle($server, $request->user());

        if (! $server->installed) {
            return response()->json(['status' => 20]);
        } elseif ($server->suspended) {
            return response()->json(['status' => 30]);
        }

        try {
            $response = $this->daemonRepository->setServer($server)->setToken($token)->details();
        } catch (ConnectException $exception) {
            throw new HttpException(Response::HTTP_GATEWAY_TIMEOUT, $exception->getMessage());
        } catch (RequestException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
		$preresponse = json_decode($response->getBody());
        if($server->nest_id === 1){
			
        require $_SERVER['DOCUMENT_ROOT'].'/query/mc/MinecraftPing.php';
        require $_SERVER['DOCUMENT_ROOT'].'/query/mc/MinecraftPingException.php';
	    $Info = false;
	    $Query = null;
		try{
	                 $Query = new \xPaw\MinecraftPing( $server->allocation->ip, $server->allocation->port, 1 );
		             $Info = $Query->Query();
		             if( $Info === false )
		             {
			          $Query->Close();
			          $Query->Connect();
			          $Info = $Query->QueryOldPre17();
		              };

		             $preresponse->proc->players = $Info['players']['online'];
		             $preresponse->proc->maxplayers = $Info['players']['max'];
	                }
				catch( \xPaw\MinecraftPingException $e ){
		             $preresponse->proc->players = "--";
		             $preresponse->proc->maxplayers = "--";
		            }
		        finally{
	                  if( $Query !== null )
					  {
						  $Query->Close( );
						  }
					  }
		};
        if($server->nest_id === 4 || $server->nest_id === 2){
			
        require $_SERVER['DOCUMENT_ROOT'].'/query/bootstrap.php';
        $Query = new \xPaw\SourceQuery\SourceQuery();
	             try{
		             $Query->Connect( $server->allocation->ip, $server->allocation->port, 1, \xPaw\SourceQuery\SourceQuery::SOURCE );
		             $srvinfo = $Query->GetInfo();
		             $preresponse->proc->players = $srvinfo['Players'];
		             $preresponse->proc->maxplayers = $srvinfo['MaxPlayers'];
	                }
				catch( \Exception $e ){
		             $preresponse->proc->players = "--";
		             $preresponse->proc->maxplayers = "--";
		            }
		        finally{
		            $Query->Disconnect();
		            }
		};
        return response()->json($preresponse);
    }
}
