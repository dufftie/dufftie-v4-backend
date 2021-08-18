<?php
namespace Controllers;

use App\Models\User;
use Database\Factories\ArtworkFactory;
use TestCase;
use Laravel\Lumen\Application;

class ArtworkControllerTest extends TestCase
{
    public function testArtworkFoundReturnsArtworkAttributes()
    {
        $af = ArtworkFactory::new();
        /**
         * @var User $artwork
         */
        $artwork = $af->make();
        $artwork->save();

        $this->get('artwork/' . $artwork->name, []);
        $this->seeStatusCode(200);
        $this->seeJson(
            [
                'name' => $artwork->name,
                'title' => $artwork->title,
                'description' => $artwork->description,
                'body' => $artwork->body,
                'publishDate' => $artwork->publishDate,
                'daysSpent' => $artwork->daysSpent,
                'preview' => $artwork->preview,
                'bgColor' => $artwork->bgColor,
                'isHidden' => $artwork->isHidden,
            ],
        );
    }

    public function testArtworkFoundButHiddenReturns403()
    {
        $af = ArtworkFactory::new();
        /**
         * @var User $artwork
         */
        $artwork = $af->make(['isHidden' => 1]);
        $artwork->save();

        $this->get('artwork/' . $artwork->name, []);
        $this->seeStatusCode(403);
    }

    public function testArtworkNotFoundReturns404()
    {
        $this->get('artwork/artworkdoesntexist');
        $this->seeStatusCode(404);
    }

    public function createApplication(): Application
    {
        return parent::createApplication();
    }
}
