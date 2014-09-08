<?php


class shoppingCentre {
   //Create your first function to oops
  static function myFirstFunction() {
     print 'Hi this is my test function';
  }
}

class latest_section {
   //$tid = arg(2);
   public $tid = 656;

   function get_latest_section_block() {
      $color = get_color_channel($this->tid);
      echo $this->color;
      /*$output .= '<div class="latest_wrapper">
                <span class="latest_label" style="background-color:'.$color.'">Latest Videos</span>
                <span class="latest_title">'.$title.'</span>';
      $output .= '<span class="view_link">'.l("View video",'node/'.$nid).'</span></div>';
      return $output;*/
   }
}

$output = new latest_section();
$output->get_latest_section_block();