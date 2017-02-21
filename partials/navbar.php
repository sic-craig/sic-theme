<div class="c-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="c-header__logo" title="Sexual Health West Sussex">
                    Sexual Health West Sussex
                </a>
            </div>
        </div>
        <a href="<?php echo home_url();?>">
            <img class="c-navigation__logo" src="<?php echo get_template_directory_uri();?>/assets/img/svg/sh-logo.svg" alt="West Sussex Sexual Health Logo" />
        </a>
    </div>
    <button type="button" class="c-header__button navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar icon-bar--top"></span>
        <span class="icon-bar icon-bar--middle"></span>
        <span class="icon-bar icon-bar--bottom"></span>
    </button>
</div>

<nav class="c-navigation">
    <div class="container">

        <div class="collapse navbar-collapse" id="primary-nav">
            <a class="c-navigation__search" data-toggle="modal" data-target="#search-modal">
                Search
            </a>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </div>
    </div>
</nav>

<div class="c-mobile-search">
    <div class="container">
        <a class="c-mobile-search__icon" data-toggle="modal" data-target="#search-modal">
            Search
        </a>
    </div>
</div>

<!-- Search Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="searchModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header--search">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color: white;" aria-hidden="true">&times;</span></button>
                <h4 id="searchModal">What are you looking for?</h4>
            </div>
            <div class="modal-body modal-body--search">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                                <label>
                                    <span class="sr-only">Search for:</span>
                                </label>
                                <div>
                                    <input type="search" class="search-field" placeholder="I think I might be pregnant..." value="" name="s" title="Search for:" >
                                    <input type="submit" value="Submit" class="c-button">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

