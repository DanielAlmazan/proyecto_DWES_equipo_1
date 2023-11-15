<?php
    class Event {
        private int $id;
        private string $description;
        private string $province;
        private string $locality;
        private string $terrainType;
        private DateTime $date;
        private string $type;
        /*
        TODO: Add attributes 'host', 'attendees' and 'species' once their respective
        classes are finished
        */
        private string $bannerPicture;
        private bool $pending;
        private bool $approved;

        public function __construct(int $id, string $description, string $province, 
            string $locality, string $terrainType, DateTime $date, string $type, 
            string $bannerPicture) {
            
            $this->id = $id;
            $this->description = $description;
            $this->province = $province;
            $this->locality = $locality;
            $this->terrainType = $terrainType;
            $this->date = $date;
            $this->type = $type;
            /*
            TODO: Add attributes 'host', 'attendees' and 'species' once their respective
            classes are finished
            */
            $this->bannerPicture = $bannerPicture;
            $this->pending = true;
            $this->approved = false;
        }

        public function __get(string $property) {
            switch($property) {
                case "id":
                    return $this->id;
                case "description":
                    return $this->description;
                case "province":
                    return $this->province;
                case "locality":
                    return $this->locality;
                case "terrainType":
                    return $this->terrainType;
                case "date":
                    return $this->date;
                case "type":
                    return $this->type;
                /*
                TODO: Add getters for 'host', 'attendees' and 'species' once their respective
                classes are finished
                */
                case "bannerPicture":
                    return $this->bannerPicture;
                case "pending":
                    return $this->pending;
                case "approved":
                    return $this->approved;
            }
        }

        public function __set(string $property, $value) {
            switch($property) {
                case "description":
                    if (strlen($value) <= 2000) {
                        $this->description = $value;
                    } else if (strlen($value) == 0) {
                        $this->description = "No description for this event.";
                    }
                    break;
                case "date":
                    if (gettype($value) == "DateTime" && $value > new DateTime()) {
                        $this->date = $value;
                    }
                    break;
                case "bannerPicture":
                    if (getimagesize($value)) {
                        $this->bannerPicture = $value;
                    }
                    break;
                case "pending":
                    $this->pending = $value;
                    break;
                case "approved":
                    $this->approved = $value;
                    break;
            }
        }
    }
?>