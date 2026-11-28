<?php

namespace App\Presentation\User;

use App\Data\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\Http\Status;
use Yiisoft\Yii\Auth\Session\AuthManager;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class UserController
{
    public function __construct(
        private AuthManager              $authManager,
        private UserRepositoryInterface  $userRepository,
        private ResponseFactoryInterface $responseFactory,
        private WebViewRenderer          $viewRenderer)
    {
    }

    public function info(): ResponseInterface
    {
        if ($this->authManager->isAuthenticated()) {
            $user = $this->userRepository->find((int)$this->authManager->getId());
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
