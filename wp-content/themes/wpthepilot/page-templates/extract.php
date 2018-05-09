<?php
/*
*	Template Name: Theme option extract
*/
get_header(); 
global $tvlgiao_wpdance_wd_data, $page_datas,$post;
?>
<pre>
<?php echo  serialize( $tvlgiao_wpdance_wd_data );?>
</pre>

<?php get_footer(); ?>
