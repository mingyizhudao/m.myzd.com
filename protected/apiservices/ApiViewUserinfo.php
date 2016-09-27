<?php

class ApiViewUserinfo extends EApiViewService {
    private $user;
    private $bookings;
    public $output;
    public function __construct($user) {
        parent::__construct();
        $this->user = $user;
    }
    /**
     * loads data by the given $user (current user).
     * @param User $user     
     */
    protected function loadData() {
        // load bookings by user.
        $this->loadBooking($this->user);
    }
    private function loadBooking($user) {
        $bookingList = Booking::model()->getBookingByMobileORUserId($user->getId(), $user->getMobile());
        if (arrayNotEmpty($bookingList)) {
            $this->setBookings($bookingList);
        }
    }

    /**
     * @param array $models array of Booking models.
     */
    private function setBookings(array $models) {
        foreach ($models as $model) {
            $booking = new stdClass();
            $booking->num = $model->num;
            $booking->bkStatus = $model->bk_status;
            $booking->bkStatusText = $model->getBkStatus();
            $this->bookings[] = $booking;
        }
    }

    // create output.
    public function createOutput() {
        if (is_null($this->output)) {
            $this->output= new stdClass();
            $this->output->status = self::RESPONSE_OK;
            $this->output->bookings = $this->bookings;
            $this->output->user =$this->user;
        }
    }

}
