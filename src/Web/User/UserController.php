<?php

namespace App\Web\User;

use App\Data\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\Http\Status;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class UserController
{
    public function __construct(
        private CurrentUser              $currentUser,
        private UserRepositoryInterface  $userRepository,
        private ResponseFactoryInterface $responseFactory,
        private WebViewRenderer          $viewRenderer)
    {
    }

    public function info(): ResponseInterface
    {
        if (!$this->currentUser->isGuest()) {
            $user = $this->userRepository->find($this->currentUser->getId());
            if ($user !== null) {
                return $this->viewRenderer->render(
                    __DIR__ . '/info_template',
                    [
                        'user' => $user,
                    ]
                );
            }
        }

        return $this->responseFactory
            ->createResponse(Status::FOUND)
            ->withHeader('Location', '/');
    }
}
