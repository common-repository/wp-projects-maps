<?php
/* render map */
function wppm_render_map($width, $height){ ?>
  <?php
  /* center geo value */
  $centergeo = get_option('center_geo');
  $centergeo_zonder = preg_replace('/\s+/', '', $centergeo);
  $centergeo_final = explode(",", $centergeo_zonder);
  ?>
  <style>#map{width:<?php echo $width; ?>; height:<?php echo $height; ?>;}</style>
  <div id="map"></div>
  <script>
      var map;
      function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
              center: <?php if($centergeo != ""){?>{lat: <?php echo $centergeo_final[0]; ?>, lng: <?php echo $centergeo_final[1]; ?>}<?php }else {?>{lat: -34.397, lng: 150.644}<?php  }?>,
              <?php if(get_option('show_gui') == "vink"){ echo "disableDefaultUI: true,";} ?>
              <?php if(get_option('disable_scroll') == "vink"){ echo "scrollwheel: false,";} ?>
              <?php if(get_option('disable_drag') == "vink"){ echo "draggable: false,";} ?>
              zoom: <?php if(get_option('mapzoom') != ""){ echo esc_attr(get_option('mapzoom')); }else { echo "8"; } ?>,
              mapTypeId: '<?php echo esc_attr(get_option("maptype")); ?>',
              <?php if(get_option('custom_map_styling') !== ""){ ?>styles: <?php echo get_option('custom_map_styling');}?>
          });
          <?php
          $args = array( 'post_type' => 'any');
          $loop = new WP_Query( $args );
          $count = 0;
          while ( $loop->have_posts() ) : $loop->the_post();
          /* data disect */
          $vol = get_post_meta(get_the_ID(), 'geolocatie_project', true);
          $zonderspatie = preg_replace('/\s+/', '', $vol);
          $deel = explode(",", $zonderspatie);
          ++$count;
          if(!empty($vol)){
          if(get_option('markeroption') == "infobox"){
          ?>
          var contentString<?php echo $count?> = '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading"><?php the_title();?></h1>'+
              '<div id="bodyContent">'+
              '<p><a href="<?php the_permalink();?>">Open project</a></p>'+
              '</div>'+
              '</div>';

          var infowindow<?php echo $count?> = new google.maps.InfoWindow({
              content: contentString<?php echo $count?>
          });
          <?php } ?>
          var marker<?php echo $count?> = new google.maps.Marker({
              position: {lat: <?php echo $deel[0]; ?>, lng: <?php echo $deel[1]; ?>},
              map: map,
              title: '<?php the_title(); ?>',
              url: '<?php the_permalink();?>'
          });
          marker<?php echo $count?>.addListener('click', function() {
              <?php if(get_option('markeroption') == "infobox"){ ?> infowindow<?php echo $count?>.open(map, marker<?php echo $count?>); <?php }?>
              <?php if(get_option('markeroption') == "directlink"){ ?> window.location.href = this.url; <?php }?>
          });
          <?php } ?>
  <?php
  endwhile;
  ?>
  }
  </script>

<?php } ?>
