<?php
namespace Middleware;

use Laravel\Lumen\Http\Request;
use App\Http\Middleware\Authenticate;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public $allowedTokens = [
        'testUser' => 'test123'
    ];

    /**
     * @dataProvider headersProvider
     * @param bool $tokenRequired
     * @param string $headerValue
     * @param bool $expResult
     * @param string $expLogMessage
     */
    public function testAuthorizationHeaderCheckedCorrectly(bool $tokenRequired, string $headerValue, bool $expResult, string $expLogMessage)
    {
        $request = new Request();

        $request->headers->set('userToken', $headerValue);
        $authenticationMock = $this->getMockBuilder(Authenticate::class)
            ->onlyMethods(['logConnection', 'getAllowedTokens', 'outputUnauthorizedResponse', 'goFurther', 'isAuthRequired'])
            ->getMock();

        $authenticationMock
            ->method('isAuthRequired')
            ->willReturn($tokenRequired);

        $authenticationMock
            ->method('getAllowedTokens')
            ->willReturn($this->allowedTokens);

        $authenticationMock
            ->method('goFurther')
            ->willReturn(true);

        $authenticationMock
            ->expects($this->once())
            ->method('logConnection')
            ->with($expLogMessage);

        if ($expResult) {
            $authenticationMock
                ->expects($this->never())
                ->method('outputUnauthorizedResponse');

            $authenticationMock
                ->expects($this->once())
                ->method('goFurther');
        }
        else {
            $authenticationMock
                ->expects($this->never())
                ->method('goFurther');

            $authenticationMock
                ->expects($this->once())
                ->method('outputUnauthorizedResponse');
        }

        $authenticationMock->handle($request, null);
    }

    /**
     * @return array|bool
     */
    public function headersProvider(): array
    {
        return [
            //No auth required, but have token
            [
                false, //Token required
                'test123', //Token
                true, //Exp. result
                'Authorization is not required. Request went further.', //Exp. log message
            ],
            //No auth required and no token
            [
                false, //Token required
                '', //Token
                true, //Exp. result
                'Authorization is not required. Request went further.', //Exp. log message
            ],
            //Auth required, and no token
            [
                true, //Token required
                '', //Token
                false, //Exp. result
                'User was blocked due to empty AuthToken.', //Exp. log message
            ],
            //Auth required and wrong token
            [
                true, //Token required
                'bull$h1t', //Token
                false, //Exp. result
                'User was blocked due to unsuitable token: \'bull$h1t\'', //Exp. log message
            ],
            //Auth required and correct token
            [
                true, //Token required
                'test123', //Token
                true, //Exp. result
                'User \'testUser\' successfully passed the authorization with key: test123', //Exp. log message
            ],
        ];
    }
}
