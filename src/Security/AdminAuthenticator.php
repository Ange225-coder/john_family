<?php

    namespace App\Security;

    use App\Repository\AdminRepository;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Http\SecurityRequestAttributes;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;

    class AdminAuthenticator extends AbstractLoginFormAuthenticator
    {
        use TargetPathTrait;

        public const LOGIN_ROUTE = 'admin_login';

        public function __construct(
            private readonly UrlGeneratorInterface $urlGenerator,
            private readonly AdminRepository $adminRepository,
            private readonly UserPasswordHasherInterface $passwordHasher
        ){}

        public function authenticate(Request $request): Passport
        {
            $adminName = $request->getPayload()->getString('adminName');
            $password = $request->getPayload()->getString('password');

            $admin = $this->adminRepository->findOneBy([
                'adminName' => $adminName
            ]);

            if (!$admin) {
                throw new CustomUserMessageAuthenticationException('Les données saisies sont incorrect. Vérifier vos informations');
            }

            if (!$this->passwordHasher->isPasswordValid($admin, $password)) {
                throw new CustomUserMessageAuthenticationException('Mot de passe incorrect');
            }

            $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $adminName);

            return new Passport(
                new UserBadge($adminName),
                new PasswordCredentials($request->getPayload()->getString('password')),
                [
                    new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                    new RememberMeBadge(),
                ]
            );
        }

        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
        {
            if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
                return new RedirectResponse($targetPath);
            }

            // For example:
             return new RedirectResponse($this->urlGenerator->generate('admin_home'));
            //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
        }

        protected function getLoginUrl(Request $request): string
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        }
    }
