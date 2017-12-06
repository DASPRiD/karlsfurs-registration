<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Middleware;

use DateTimeImmutable;
use DateTimeZone;
use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Suitwalk\Domain\Event\GetAllEventsInterface;
use Zend\Diactoros\Response;

final class ICal
{
    /**
     * @var GetAllEventsInterface
     */
    private $getAllEvents;

    public function __construct(GetAllEventsInterface $getAllEvents)
    {
        $this->getAllEvents = $getAllEvents;
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $vCalendar = new Calendar('karlsfurs.de');

        foreach ($this->getAllEvents->__invoke() as $event) {
            $date = $event->getDate();

            $vEvent = new Event();
            $vEvent->setDtStart($this->createFullDate($date, $event->getMeetingTime()));
            $vEvent->setDtEnd($this->createFullDate($date, $event->getReturnTime()));
            $vEvent->setSummary(sprintf('Karlsfurs Suitwalk'));
            $vEvent->setLocation(str_replace("\n", ', ', $event->getMeetingPointAddress()));
            $vEvent->setDescription(sprintf('Departure at %s', $event->getDepartureTime()->format('H:i')));
            $vCalendar->addComponent($vEvent);

            $vEvent = new Event();
            $vEvent->setDtStart($this->createFullDate($date, $event->getDinnerTime()));
            $vEvent->setDtEnd($this->createFullDate($date, $event->getDinnerTime()->modify('+2 hours')));
            $vEvent->setSummary(sprintf('Karlsfurs Dinner'));
            $vEvent->setLocation(str_replace("\n", ', ', $event->getRestaurantAddress()));
            $vCalendar->addComponent($vEvent);
        }

        $response = new Response('php://memory', 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="karlsfurs-suitwalks.ics"',
        ]);
        $response->getBody()->write($vCalendar->render());
        return $response;
    }

    private function createFullDate(DateTimeImmutable $date, DateTimeImmutable $time) : DateTimeImmutable
    {
        return $date->setTime(
            (int) $time->format('H'),
            (int) $time->format('i'),
            (int) $time->format('s')
        )->setTimezone(new DateTimeZone('UTC'));
    }
}
