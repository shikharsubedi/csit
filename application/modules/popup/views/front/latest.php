<script type="text/javascript" src="<?php echo theme_url() ?>/js/datepicker/datepicker.js"></script>
<link href="<?php echo theme_url() ?>/js/datepicker/datepicker.css" rel="stylesheet" type="text/css" />

<div id="popup"  title="<?php echo (array_key_exists('title', $popup)) ? $popup['title'] : $popup[0]['title']; ?>">
    <div id="popup_body"><?php echo (array_key_exists('body', $popup)) ? $popup['body'] : $popup[0]['body']; ?></div>

</div>
<script type="text/javascript">
    $(function () {
        $('#popup').dialog({
            autoOpen: true,
            resizable: false,
            draggable: false,
            modal: true,
            minWidth: 600,
            maxWidth: 600,
            create: function () {
                var oheight = $(document).height();
                $('#overlay').css('height', oheight);
                $('#overlay').toggle();
            },
            close: function () {
                $('#overlay').toggle();
            }
        });
        $('#popup').parent('div').attr('id', 'popupframe')
        $('#popup').parent('div').css('z-index', '100001', 'background', '000000')

    })

</script>