<?php

Class MP_Visitor {

  private $session_id;
  private $ip_address;
  private $lat;
  private $lng;
  private $country;
  private $country_code;
  private $continent;
  private $timestamp;
  private $post;

  public function setData( $data ) {
    $this->session_id = $data['session_id'];
    $this->ip_address = $data['ip_address'];
    $this->lat = $data['lat'];
    $this->lng = $data['lng'];
    $this->timestamp = $data['timestamp'];
    $this->country_code = $data['country_code'];
    $this->country = $data['country'];
    $this->continent = $data['continent'];
  }

  protected function args( $meta_query ) {
    return array(
      'post_type' =>  'mp_visitor',
      'posts_per_page'  =>  1,
      'meta_query'  => $meta_query,
    );
  }

  public function check_visitor_status( $ip = null ) {
    $status = 0;
    $query = array(
      array(
        'key'  =>  'mp_v_ip_address',
        'value'  =>  $this->ip_address,
      ),
      array(
        'key'  =>  'mp_v_session_id',
        'value'  =>  $this->session_id,
      ),
      array(
        'key'  =>  'mp_v_active_status',
        'value'  =>  'online',
      ),
    );
    $visitor = get_posts( $this->args( $query ) );

    if( count( $visitor ) > 0 ) {
      $status = 1;
    }

    return $status;
  }

  public function check_visitor_exist( $ip = null ) {
    $query = array(
      array(
        'key'  =>  'mp_v_ip_address',
        'value'  =>  $this->ip_address,
      ),
      array(
        'key'  =>  'mp_v_session_id',
        'value'  =>  $this->session_id,
      ),
      array(
        'key' => 'mp_v_timestamp',
        'value' => array( strtotime('-1 day'), strtotime( date() ) ),
        'compare' => 'NOT BETWEEN'
      ),
    );

    $visitor = get_posts( $this->args( $query ) );

    return $visitor;
  }

  public function update_visitor_timestamp( $post_id = null ) {
    update_field('mp_v_timestamp', $this->timestamp, $post_id);
  }

  public function update_visitor_status( $status, $post_id = null ) {
    update_field('mp_v_active_status', $status, $post_id);
  }

  public function save() {
    $saved = 0;

    $saved = wp_insert_post( array(
      'post_type' =>  'mp_visitor',
      'post_title'  =>  $this->ip_address.' From '.$this->country_code,
      'post_status' =>  'publish',
    ) );
    $this->post = $saved;
    if( $this->post != 0 ) {
      update_field('mp_v_session_id', $this->session_id, $saved);
      update_field('mp_v_ip_address', $this->ip_address, $saved);
      update_field('mp_v_latitude', $this->lat, $saved);
      update_field('mp_v_longitude', $this->lng, $saved);
      update_field('mp_v_country_code', $this->country_code, $saved);
      update_field('mp_v_country', $this->country, $saved);
      update_field('mp_v_continent', $this->continent, $saved);
      update_field('mp_v_timestamp', $this->timestamp, $saved);
      update_field('mp_v_active_status', 'online', $saved);
    }

    return $saved;
  }

}

?>
