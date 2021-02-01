<?php
/* Template Name: Template: Home */


function home_loop()
{
?>
   <section class="home--hero">
        <div class="home--hero__slider">
            <div class="home--slide">
                <div class="home--slide__content">
                    <h2>jp funride <br>2021</h2>
                    <p>
                        Super easy going freeride boards based on the X-Cite Ride shape concept with additional control and super easy jibing. 
                    </p>
                    <a href="#">buy now</a>
                </div>
            </div>
        </div>
   </section>
<?php
}
add_action('genesis_after_header', 'home_loop');
remove_action('genesis_loop', 'genesis_do_loop');


genesis();
