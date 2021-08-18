<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Response;

class ArtworkController extends BaseController
{
    public function getPageInfo($artwork): Response
    {
        /**
         * @var Artwork $artworkObj
         */
        $artworkObj = Artwork::where([Artwork::NAME => $artwork])->first();
        if($artworkObj === null) {
            $this->logInfo("Artwork '$artwork' doesn't exist. Returning error 404.");
            return new Response(null, 404);
        }
        else if ($artworkObj->isHidden == true) {
            $this->logInfo("Artwork '$artwork' is found, but hidden. Returning error 403.");
            return new Response(null, 403);
        }
        $responseBody = $artworkObj->toJson();
        $this->logInfo("Returning all info about: '$artwork'.", ['Response body', $responseBody]);
        return new Response($artworkObj->toJson(), 200);
    }
}
