<?php
declare(strict_types = 1);

namespace Suitwalk\Infrastructure\Handler;

use DateTimeImmutable;
use DateTimeZone;
use Eluceo\iCal\Component\Calendar as VCalendar;
use Eluceo\iCal\Component\Event as VEvent;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Suitwalk\Domain\Event\Event;
use Suitwalk\Domain\Event\GetAllEventsInterface;
use Zend\Diactoros\Response;

final class ICalHandler implements RequestHandlerInterface
{
    /**
     * @var GetAllEventsInterface
     */
    private $getAllEvents;

    public function __construct(GetAllEventsInterface $getAllEvents)
    {
        $this->getAllEvents = $getAllEvents;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $vCalendar = new VCalendar('karlsfurs.de');
        $events = $this->getAllEvents->__invoke();

        usort($events, function (Event $a, Event $b) : int {
            return $a->getDate() <=> $b->getDate();
        });

        foreach ($events as $event) {
            $date = $event->getDate();

            $vEvent = new VEvent();
            $vEvent->setDtStart($this->createFullDate($date, $event->getMeetingTime()));
            $vEvent->setDtEnd($this->createFullDate($date, $event->getReturnTime()));
            $vEvent->setSummary(sprintf('Karlsfurs Suitwalk'));
            $vEvent->setLocation(str_replace("\n", ', ', $event->getMeetingPointAddress()));
            $vEvent->setDescription(sprintf('Departure at %s', $event->getDepartureTime()->format('H:i')));
            $vCalendar->addComponent($vEvent);

            $vEvent = new VEvent();
            $vEvent->setDtStart($this->createFullDate($date, $event->getDinnerTime()));
            $vEvent->setDtEnd($this->createFullDate($date, $event->getDinnerTime()->modify('+2 hours')));
            $vEvent->setSummary(sprintf('Karlsfurs Dinner'));
            $vEvent->setLocation(str_replace("\n", ', ', $event->getRestaurantAddress()));
            $vCalendar->addComponent($vEvent);
        }

        $vCalendar->setCalId('karlsfurs.de');
        $vCalendar->setName('Karlsfurs');
        $vCalendar->setDescription('Suitwalks and dinners for Karlsfurs');
        $vCalendar->setCalendarColor('#F67D07');
        $vCalendar->setPublishedTTL('P1D');

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
