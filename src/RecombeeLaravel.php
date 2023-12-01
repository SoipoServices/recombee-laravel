<?php

namespace Soiposervices\RecombeeLaravel;

use Illuminate\Support\Facades\Log;
use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests\AddItemProperty;
use Recombee\RecommApi\Exceptions\ResponseException;
use Recombee\RecommApi\Requests\AddUserProperty;
use Recombee\RecommApi\Requests\Batch;
use Recombee\RecommApi\Requests\Request;
use Recombee\RecommApi\Requests\ResetDatabase;

class RecombeeLaravel
{
    public function __construct(
            private string $databaseId,
            private string $databaseToken,
            private string $region) {}


    public function client(array $options = []):Client{
        $options['region']=$this->region;
        return new Client($this->databaseId, $this->databaseToken, $options);
    }

    /**
     * Send an api request silently
     */
    public function send(Request $request,array $options = []): mixed{
        $client = $this->client($options);
        try{
           return $client->send($request);
        }catch(ResponseException $e){
           $this->handleException($e);
           return null;
        }
    }

    /**
     * Reset the database
     */
    public function resetDatabase(): mixed{
       $result = $this->send(new ResetDatabase());
       Log::warning($result);
       return $result;
    }


    /**
     * Send an api request silently
     *
     * @param Request[] $requests Array of Requests.
     * @param array $optional Optional parameters given as an array containing pairs name of the parameter => value
     *
     */
    public function batch(array $requests,array $options = []): mixed{
        $result = $this->send(new Batch($requests,$options));
        if(is_array($result)){
            $requestsCount = count($requests);
            $okCount = collect($result)->count('ok');
            Log::debug("Requests executed with success: {$okCount}/{$requestsCount}");
        }

        return $result;
    }



    /**
     * Handle an exeption and logs it
     */
    public function handleException(ResponseException $exception){
       try{
        $message = json_decode($exception->getMessage())?->message;
        Log::alert("Recombee ResponseException: ".$message);
       }catch(\Exception $e){
         Log::alert($exception->getMessage());
       }
    }

    /**
     * Sync properties to recombee
     */
    public function syncProperties(){

        $requests = [];
        $itemProperties = config('recombee.properties.item');
        if(!is_null($itemProperties) && count($itemProperties) > 0){
            foreach($itemProperties as $property_name => $type){
                $requests[] = new AddItemProperty($property_name, $type);
            }
        }else{
            Log::warning("No item property has been set.");
        }

        $userProperties = config('recombee.properties.user');
        if(!is_null($userProperties) && count($userProperties) > 0){
            foreach($userProperties as $property_name => $type){
                $requests[] = new AddUserProperty($property_name, $type);
            }
        }else{
            Log::warning("No user property has been set.");
        }

        if(count($requests) > 0){
            $this->batch($requests);
        }
    }

}
