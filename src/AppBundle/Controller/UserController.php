<?php


namespace AppBundle\Controller;



use AppBundle\Entity\User;
use AppBundle\Form\UserRegistrationForm;
use AppBundle\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request
        , LoginFormAuthenticator $authenticator
        , GuardAuthenticatorHandler $authenticatorHandler)
    {
        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            /**
             * @var User $user
             */
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Welcome '.$user->getEmail());

            return $authenticatorHandler
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main'
                );
        }
        return $this->render('user/register.html.twig', [
           'form' => $form->createView()
        ]);
    }
}