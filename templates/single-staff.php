<?php get_template_part('templates/page', 'header'); ?>
<div class="wrap container" role="document">
  <div class="content row">
    <main class="main" role="main">
		<?php while (have_posts()) : the_post();
			
		if( "" != get_the_post_thumbnail_url( $post->ID, 'thumbnail') ):
			$post_thumb = get_the_post_thumbnail_url( $post->ID);
		else:
			$post_thumb = plugins_url('../assets/img/profile-placeholder.jpg', __FILE__);
		endif;	
		?>
		  <article <?php post_class(); ?>>
		    <header>
			  <img src="<? echo $post_thumb; ?>">
			  <div class="profile-info">
		      	<h1 class="entry-title"><?php the_title(); ?></h1>
			  	<span><?php the_staff_title(); ?></span>
			  	<p><i class='fa fa-envelope-o'></i> <a href="<?php the_staff_email(); ?>"><?php the_staff_email(); ?></a></p>
			  </div>
		    </header>
		    <div class="entry-content">
		      <?php the_content(); ?>
		    </div>
		    <footer>
		      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
		    </footer>
		  </article>
		<?php endwhile; ?>

    </main><!-- /.main -->
  </div><!-- /.content -->
</div><!-- /.wrap -->