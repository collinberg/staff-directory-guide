<?php get_template_part('templates/page', 'header'); ?>
<div class="wrap container" role="document">
  <div class="content row">
    <main class="main col-sm-12" role="main">
      

	  <?php if (!have_posts()) : ?>
	    <div class="alert alert-warning">
		  <?php _e('Sorry, no results were found.', 'roots'); ?>
	    </div>
	    <?php get_search_form(); ?>
	  <?php endif; ?>

	  <?php while (have_posts()) : the_post(); 
		
		if( "" != get_the_post_thumbnail_url( $post->ID, 'thumbnail') ):
			$post_thumb = get_the_post_thumbnail_url( $post->ID, 'full');
		else:
			$post_thumb = plugins_url('../assets/img/profile-placeholder.jpg', __FILE__);
		endif;
	  ?>
	    <div class="col-sm-6 col-lg-3 col-md-4">
	      <article <?php post_class(); ?>>
		    <header>
			  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="profileLink">
				  <img src="<?php echo $post_thumb; ?>" alt="<?php the_title(); ?>">
				  <div class="hover-area">
					  <div class="hoverbg"></div>
					  <span>&rarr;</span>
				  </div>
			  </a>  
		      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		      <span><?php the_staff_title(); ?></span>

		    </header>

		  </article>
	    </div>
	    
	  <?php endwhile; ?>

	 
    </main><!-- /.main -->
 <?php if ($wp_query->max_num_pages > 1) : ?>
	    <nav class="post-nav">
		  <ul class="pager">
		    <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
		    <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
		  </ul>
	    </nav>
	  <?php endif; ?>    
  </div><!-- /.content -->
</div><!-- /.wrap -->
