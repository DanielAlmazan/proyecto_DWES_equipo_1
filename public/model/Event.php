<?php
    class Event {
        private int $id;
        private string $name;
        private string $description;
        private string $province;
        private string $locality;
        private string $terrainType;
        private DateTime $date;
        private string $type;
        /*
        TODO: Add attributes 'host', 'attendees' and 'species' once their respective
         model are finished
        */
        private string $bannerPicture;
        private bool $pending;
        private bool $approved;

        public function __construct(string $name, string $description, string $province,
            string $locality, string $terrainType, DateTime $date, string $type, 
            string $bannerPicture, int $id = null) {
            $this->name = $name;
            $this->description = $description;
            $this->province = $province;
            $this->locality = $locality;
            $this->terrainType = $terrainType;
            $this->date = $date;
            $this->type = $type;
            /*
            TODO: Add attributes 'host', 'attendees' and 'species' once their respective
             model are finished
            */
            $this->bannerPicture = $bannerPicture;
            $this->pending = true;
            $this->approved = false;

            if ($id != null) {
                $this->id = $id;
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function setDescription(string $description): void {
            $this->description = $description;
        }

        public function getProvince(): string {
            return $this->province;
        }

        public function setProvince(string $province): void {
            $this->province = $province;
        }

        public function getLocality(): string {
            return $this->locality;
        }

        public function setLocality(string $locality): void {
            $this->locality = $locality;
        }

        public function getTerrainType(): string {
            return $this->terrainType;
        }

        public function setTerrainType(string $terrainType): void {
            $this->terrainType = $terrainType;
        }

        public function getDate(): DateTime {
            return $this->date;
        }

        public function setDate(DateTime $date): void {
            $this->date = $date;
        }

        public function getType(): string {
            return $this->type;
        }

        public function setType(string $type): void {
            $this->type = $type;
        }

        public function getBannerPicture(): string {
            return $this->bannerPicture;
        }

        public function setBannerPicture(string $bannerPicture): void {
            $this->bannerPicture = $bannerPicture;
        }

        public function isPending(): bool {
            return $this->pending;
        }

        public function setPending(bool $pending): void {
            $this->pending = $pending;
        }

        public function isApproved(): bool {
            return $this->approved;
        }

        public function setApproved(bool $approved): void {
            $this->approved = $approved;
        }
    }

?>