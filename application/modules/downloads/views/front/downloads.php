<div class="faq-module-front-container">
    <?php if ($download_cat): ?>
        <?php foreach ($download_cat as $dc): ?>
            <div class="faq-accordion report_list">
                <h4>
                    <a href="#faqblock-<?php echo $dc['id'] ?>" class="faq-category"><?php echo $dc['name'] ?>
                    </a>
                </h4>
                <div id="faqblock-<?php echo $dc['id'] ?>"
                     class="faqblock <?php echo (implode('-', explode(' ', strtolower($dc['name']))) != $active) ? 'active' : 'inactive' ?>">
                    <ul>
                        <?php
                        foreach ($dc['items'] as $d):
                            $file = explode('.', $d['file']);
                            $ext = $file[1];
                            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
                                $url = base_url() . "assets/upload/downloads/" . $d['file'];
                            else
                                $url = site_url('download/files/' . $d['file']);
                            ?>
                            <li><a href="<?php echo site_url('download/files/' . $d['file']); ?>" title="Download <?php echo $d['name'] ?>"><?php echo $d['name']; ?>
                                </a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach ?>
    <?php endif; ?>

</div>

<script>

    $(function () {

        var TIME = 500,
                theme_url = '<?php echo theme_url() ?>';
        var handle = $('.faq-accordion');
        handle.find('div.inactive').hide();

        handle.find('.faq-category').each(function (i) {
            $(this).bind('click', function (e) {
                var anchr = $(this);
                e.preventDefault();
                var id = '#faqblock-' + anchr.attr('href').split('-')[1];
                var block = $(id);
                if (!block.is(':visible')) {
                    var tohide = handle.find('div.faqblock:visible');
                    tohide.slideUp(TIME);
                    var hideanchr = tohide.prev('h4').children('.faq-category');
                    hideanchr.css({background: 'url(' + theme_url + 'images/bullet_faq.gif) no-repeat 0 -2px'}); // change url if required
                    block.slideDown(TIME);
                    anchr.css({background: 'url(' + theme_url + 'images/bulletdown.gif) no-repeat 0 -2px'}); // change url if required
                } else
                {
                    block.slideUp(TIME);
                    anchr.css({background: 'url(' + theme_url + 'images/bullet_faq.gif) no-repeat 0 -2px'}); // change url if required
                }
                ;
            })
        });

    });
</script>
