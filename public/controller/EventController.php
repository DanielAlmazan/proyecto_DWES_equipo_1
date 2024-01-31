<?php
    use Event;

    class EventController {
        private array $events;

        public function __construct(array $events) {
            $this->events = $events;
        }

        public function __get(string $property) {
            switch ($property) {
                case "events":
                    return $this->events;
            }
        }

        public function __set(string $property, $value) {
            switch ($property) {
                case "events":
                    $this->events = $value;
                    break;
            }
        }

        public function addEvent(Event $newEvent): bool {
            $this->events[] = $newEvent;
            return true;
        }

        public function filterString(string $field, string $value): array {
            return array_filter($this->events, function ($event) use ($field, $value) {
                return $event->$field === $value;
            });
        }

        public function filterDate(DateTime $date) {
            return array_filter($this->events, function ($event) use ($date) {
                return $event->date === $date;
            });
        }

        /*
        TODO 
        - Filter by host once the User class is implemented
        - Filter by approval
        */
    }

    ?>