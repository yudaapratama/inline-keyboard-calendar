<?php

namespace yudaapratama\Calendar;

/**
 * Class InlineKeyboardCalendar
 *
 * @package yudaapratama\Calendar
 */
class InlineKeyboardCalendar
{

  protected $date;
  protected $year;
  protected $month;

  /**
   * @param date $date
   *
   * @return int
   */
  public function setConfigDate($date)
  {
    $this->date = $date;
  }

  /**
   * List of date labels.
   *
   *
   * @return array
   */
  private function listOfDate()
  {

    list($year, $month) = explode('-', $this->date);
    $this->month = $month;
    $this->year = $year;

    $start_date = "01-".$month."-".$year;
    $start_time = strtotime($start_date);

    $end_time = strtotime("+1 month", $start_time);

    for($i=$start_time; $i<$end_time; $i+=86400)
    {
      $date = date('Y-m-d', $i);
      $day = date('w', $i);
      $list[$this->weekOfMonth($date)][$day] = date('d', $i);
    }

    return $list;

  }

  /**
   * Generate calendar
   *
   *
   * @return array
   */
  public function Calendar()
  {
    $arrays = array('1' => 'Sen', '2' => 'Sel', '3' => 'Rab', '4' => 'Kam', '5' => 'Jum', '6' => 'Sab', '0' => 'Min');
    $lists = $this->listOfDate();

    $keyboard = [];

    $keyboard[] = [
      ['text' => $this->month . ' ' . $this->year, 'callback_data' => 'ignore::' . $this->month . $this->year]
    ];

    foreach ($arrays as $array) {
      $header[] = ['text' => $array, 'callback_data' => 'ignore::' . $array];
    }

    $keyboard[] = $header;


    foreach ($lists as $keyList => $valueList) {
      $row = [];
        foreach ($arrays as $keyArray => $valueArray) {
          if (isset($lists[$keyList][$keyArray])) {
            $row[] = ['text' => $lists[$keyList][$keyArray], 'callback_data' => 'day::' . $this->year . '-' . $this->month . '-' . $lists[$keyList][$keyArray]];
          } else {
            $row[] = ['text' => '-', 'callback_data' => 'ignore::' . $keyArray];
          }
        }
        $keyboard[] = $row;
    }

    $keyboard[] =
    [
      ['text' => '« Prev Month', 'callback_data' => 'prev::' . $this->prevMonth($this->year . '-' . $this->month)],
      ['text' => 'Next Month »', 'callback_data' => 'next' . $this->nextMonth($this->year . '-' . $this->month)]

    ];

    return $keyboard;

  }

  /**
   * Set the the prev month on callback.
   *
   *
   * @return date
   */
  private function prevMonth()
  {
    $month = date('Y-m', strtotime($this->date . " -1 month"));
    return $month;
  }

  /**
   * Set the the next month on callback.
   *
   *
   * @return date
   */
  private function nextMonth()
  {
    $month = date('Y-m', strtotime($this->date . " +1 month"));
    return $month;
  }

  /**
   * @param date $date
   *
   * @return int
   */
  private function weekOfMonth($date) {
      $firstOfMonth = date("Y-m-01", strtotime($date));
      return intval(date("W", strtotime($date))) - intval(date("W", strtotime($firstOfMonth)));
  }

}


 ?>
