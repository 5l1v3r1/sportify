<?php

namespace Devlabs\SportifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ChampionController
 * @package Devlabs\SportifyBundle\Controller
 */
class ChampionController extends Controller
{
    /**
     * @Route("/champion/{tournament_id}",
     *     name="champion_index",
     *     defaults={
     *      "tournament_id" = "empty"
     *     }
     * )
     */
    public function indexAction(Request $request, $tournament_id)
    {
        // if user is not logged in, redirect to login page
        if (!is_object($user = $this->getUser())) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $urlParams['tournament_id'] = $tournament_id;

        // Get an instance of the Entity Manager
        $em = $this->getDoctrine()->getManager();

        // get user joined tournaments as source data for form choices
        $formSourceData['tournament_choices'] = $em->getRepository('DevlabsSportifyBundle:Tournament')
            ->getJoined($user);

        // get informational message if user has not joined any tournaments
        if (!$formSourceData['tournament_choices']) {
            // get the user's tournaments position data
            $userScores = $em->getRepository('DevlabsSportifyBundle:Score')
                ->getByUser($user);
            $this->container->get('twig')->addGlobal('user_scores', $userScores);

            return $this->render('Champion/info_no_tournaments.html.twig');
        }

        /**
         * Set first joined tournament as selected if URL param is 'empty'
         * or get the tournament by the URL tournament_id value
         */
        $formSourceData['tournament_selected'] = ($tournament_id === 'empty')
            ? $formSourceData['tournament_choices'][0]
            : $em->getRepository('DevlabsSportifyBundle:Tournament')->findOneById($tournament_id);

        // get the filter helper service
        $filterHelper = $this->container->get('app.filter.helper');

        // set the fields for the filter form
        $fields = array('tournament');

        // set the input data for the filter form and create it
        $formInputData = $filterHelper->getFormInputData($request, $urlParams, $fields, $formSourceData);
        $filterForm = $filterHelper->createForm($fields, $formInputData);
        $filterForm->handleRequest($request);

        // if the filter form is submitted, redirect with appropriate url path parameters
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $submittedParams = $filterHelper->actionOnFormSubmit($filterForm, $fields);

            return $this->redirectToRoute('champion_index', $submittedParams);
        }

        // set the deadline for champion prediction
        $tournamentStartTime = $formSourceData['tournament_selected']->getStartDate();
        $deadline = date_format($tournamentStartTime,"Y-m-d H:i");

        //if bet champion deadline has passed, set disabled attribute to true, else - false
        $disabledAttribute = (time() >= strtotime($deadline)) ? true : false;

        // get the champion helper service
        $championHelper = $this->container->get('app.champion.helper');

        // get user's champion prediction or null if there's none
        $predictionChampion = $championHelper->getPredictionChampion($user, $formSourceData['tournament_selected']);

        $formInputData = $championHelper->getFormInputData($predictionChampion, $formSourceData['tournament_selected']);
        $buttonAction = $formInputData['button_action'];
        $championForm = $championHelper->createForm($formInputData);

        $championForm->handleRequest($request);

        // if the filter form is submitted, redirect with appropriate url path parameters
        if ($championForm->isSubmitted() && $championForm->isValid()) {
            // reload the page is form is submitted but deadline has passed
            if ($disabledAttribute)
                // clear the submitted POST data and reload the page
                return $this->redirectToRoute('champion_index', $urlParams);

            $championHelper->actionOnFormSubmit($championForm, $user, $predictionChampion, $formSourceData['tournament_selected']);

            // reload the page with the chosen filter(s) applied (as url path params)
            return $this->redirectToRoute('champion_index', $urlParams);
        }

        // get a list of all users Champion predictions for the selected tournament
        $championPredictions = $em->getRepository('DevlabsSportifyBundle:PredictionChampion')
            ->findByTournamentId($formSourceData['tournament_selected']);

        // get user standings and set them as global Twig var
        $this->get('app.twig.helper')->setUserScores($user);

        // rendering the view and returning the response
        return $this->render(
            'Champion/index.html.twig',
            array(
                'filter_form' => $filterForm->createView(),
                'champion_form' => $championForm->createView(),
                'prediction_champion' => $predictionChampion,
                'user_predictions' => $championPredictions,
                'deadline' => $deadline,
                'disabled_attribute' => $disabledAttribute,
                'button_action' => $buttonAction
            )
        );
    }
}
