<?php

Class MP_Visitor {

  private $ip_address;
  private $lat;
  private $lng;
  private $country;
  private $country_code;
  private $continent;
  private $timestamp;

  public function __construct( $data ) {
    $this->setData( $data );

  }

  protected function setData( $data ) {
    $this->ip_address = $data['ip_address'];
    $this->lat = $data['lat'];
    $this->lng = $data['lng'];
    $this->timestamp = $data['time'];
    $this->country_code = $data['country_code'];
    $this->country = $data['country'];
    $this->continent = $data['continent'];
  }

  protected function args( $meta_query ) {
    return array(
      'post_type' =>  'mp_visitor',
      'posts_per_page'  =>  1,
      'meta_query'  => $meta_query
    );
  }

  public function check_visitor_status( $ip = null ) {
    $status = 0;
    $query = array(
      array(
        'meta_key'  =>  'mp_visitor_ip_address',
        'meta_value'  =>  $this->ip_address,
      ),
      array(
        'meta_key'  =>  'mp_visitor_status',
        'meta_value'  =>  'online',
      ),
    );
    $visitor = get_post( $this->args( $query ) );

    if( count( $visitor ) > 0 ) {
      $status = 1;
    }

    return $status;
  }

  public function save_visitor() {
    $saved = 0;

    $saved = wp_insert_post( array(
      'post_type' =>  'mp_visitor',
      'post_title'  =>  $this->ip_address.' From '.$this->country_code,
      'post_status' =>  'publish',
    ) );

    //update_field()

    return $saved;
  }

}

?>
