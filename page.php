<?php get_header(); ?>
<div style="padding:48px 5%;max-width:900px;margin:0 auto;">
  <?php while (have_posts()): the_post(); ?>
    <h1 style="font-family:'Playfair Display',serif;font-size:clamp(1.8rem,3vw,2.6rem);color:var(--text);margin-bottom:24px;"><?php the_title(); ?></h1>
    <div style="font-size:.88rem;color:var(--text-mid);line-height:1.8;"><?php the_content(); ?></div>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
