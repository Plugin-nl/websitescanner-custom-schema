<?php

/**
 * Provide a editor area view for the plugin
 * *
 * @link       https://timvaniersel.com/en/
 * @since      1.0.0
 *
 * @package    Websitescanner_Custom_Schema
 * @subpackage Websitescanner_Custom_Schema/admin/partials
 */

//Grab all options
$options = get_post_meta(get_the_ID(), 'websitescanner_custom_schema_post_data', true);

if (empty($options)) {
  $options = array();
  $options['custom_schema_0'] = false;
  $options['custom_schema_1'] = false;
  $options['custom_schema_2'] = false;
}
foreach ($options as $key => $option) {
  ${$key} = $option;
}



?>
<p>
  <?php esc_attr_e( 'Write down your JSON-ld Schema markup for this page without the &lt;script&gt; tags. For more info about schema visit ', $this->plugin_name ); ?> <a target="_blank" href="https://schema.org">Schema.org</a>.</p><p>
  <?php esc_attr_e( 'To check if your Schema is correct you can use the ', $this->plugin_name ); ?> <a target="_blank" href="https://search.google.com/structured-data/testing-tool/u/0/<?php if ( get_post_status ( get_the_ID() ) == 'publish' ) { echo "#url=" . urlencode(get_permalink(get_the_ID())); } ?>">Google Structured Data Testing Tool</a> 
  <?php esc_attr_e( '(Your page/post has to be published for this) ', $this->plugin_name ); ?>.
</p><br>

<textarea name="<?php echo $this->plugin_name; ?>[custom_schema_0]" data-id="0" id="webs-custom-schema-0" class="webs-custom-schema widefat" cols="50" rows="5"><?php if (isset($custom_schema_0)){ echo wp_unslash(json_decode($custom_schema_0));} ?></textarea>
<label for="webs-custom-schema-0" class="webs-custom-schema-error" id="webs-custom-schema-errors-0" class=""><?php esc_attr_e('Unchanged', $this->plugin_name); ?></label></br><br>

<?php if(!$custom_schema_1 && !$custom_schema_2){ ?>
<div class="webs-more-link">
<a href="#" class="show-custom-schema-fields components-button is-button is-default is-large">Show more JSON-ld fields</a>
</div>
<?php } ?>
<span class="webs-schema-1 <?php if(!$custom_schema_1 && !$custom_schema_2){echo "hidden";}?>">
<textarea name="<?php echo $this->plugin_name; ?>[custom_schema_1]" data-id="1" id="webs-custom-schema-1" class="webs-custom-schema widefat" cols="50" rows="5"><?php if (isset($custom_schema_1)){echo wp_unslash(json_decode($custom_schema_1));} ?></textarea>
<span class="webs-custom-schema-error" id="webs-custom-schema-errors-1" class=""><?php esc_attr_e('Unchanged', $this->plugin_name); ?></span></br><br>
</span>
<span class="webs-schema-2 <?php if(!$custom_schema_1 && !$custom_schema_2){echo "hidden";}?>">
<textarea name="<?php echo $this->plugin_name; ?>[custom_schema_2]" data-id="2" id="webs-custom-schema-2" class="webs-custom-schema widefat" cols="50" rows="5"><?php if (isset($custom_schema_2)){echo wp_unslash(json_decode($custom_schema_2));} ?></textarea>
<span class="webs-custom-schema-error" id="webs-custom-schema-errors-2" class=""><?php esc_attr_e('Unchanged', $this->plugin_name); ?></span></br><br>
</span>
<span class="webs-more-link hidden">
<a href="#" class="show-custom-schema-fields components-button is-button is-default is-large">Show less JSON-ld fields</a>
</span>
