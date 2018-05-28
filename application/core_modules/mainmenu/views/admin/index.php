<div class="response info" >Your current theme only supports nesting upto level <?php echo _t('mainmenu_max_nest_level') ?></div>
<div class="grid_5">
    <div class="section">
        <h4>External link</h4>
        <div class="content">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="link">URL</label></th>
                    <td><input type="text" class="regular-text" id="url-link" value="http://" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="label">Label</label></th>
                    <td><input type="text" class="regular-text" id="url-label" value="" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="button" class="button" id="add_url" value="Add To Menu" /></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="section">
        <h4>Page</h4>
        <div class="content">
            <div style="max-height:200px; overflow:auto">
                <?php echo pageSelectTree(NULL, 'checkbox'); ?>
                <?php echo articleSelectTree(NULL, 'checkbox'); ?>
            </div>
            <p style="padding-top:15px;"><a href="#" id="add_page" class="button">Add to menu</a></p>
        </div>
    </div>

    <div class="section">
        <h4>Category</h4>
        <div class="content">

            <div style="max-height:200px; overflow:auto"><?php echo categorySelectTree(NULL, 'checkbox'); ?></div>
            <p style="padding-top:15px;"><a href="#" id="add_category" class="button">Add to menu</a></p>
        </div>
    </div>
    
    

</div>
<div class="grid_6">
    <div class="section">
        <h4>The main menu</h4>
        <div class="content" id="playground">
            <div class="response info" id="save-notif" style="display:none">Your changes have not been saved.Please click on save to save the changes.</div>
            <?php 
            $attributes = array('name' => 'update-main-menu', 'id' => 'update-main-menu', 'method' => 'post');
            $url = current_url();
            echo form_open($url,$attributes);
            ?>
            <!-- <form name="update-main-menu" id="update-main-menu" method="post" action=""> -->
                <ol class="sortable">
                    <?php
                    if ($tree)
                        echo _admin_manage_menu_tree($tree);
                    ?>
                </ol>

                <table class="form-table">
                    <tr>
                        <td><input type="hidden" name="serial" id="sortable-order" value="" />

                        </td>
                        <td align="right" width="10%"><input type="submit" value="Save" class="button" id="save_menu" style="display:none;"/></td>
                    </tr>
                </table>
            <!-- </form> -->
            <?php echo form_close() ?>

        </div>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
//var menuCount = $('ol.sortable').children('li').length;
    var menuCount = 1000;
    $(function () {
        $('ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            maxLevels: <?php echo _t('mainmenu_max_nest_level') ?>,
            opacity: .6,
            placeholder: 'placehldr',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div'
        });

        $('ol.sortable').bind('sortupdate', function (e) {
            $('#save-notif').show();
            $('#save_menu').show();

            //console.log(e.target);
            //update the order
            var _orders = $('input.order');

            _orders.each(function (i) {
                $(this).val(i);
            });
        });

        $('.item-control').live('click', function () {
            var config = $(this).closest('li').children('div.menu_controls').slideToggle();
        });

        /**************/
        $('#add_url').click(function () {
            //check if the label and url were filled in
            var url = $('#url-link').val(),
                    label = $('#url-label').val();

            if (label == '' || url == 'http://')
                return false;

            var _id = menuCount++,
                    _order = $('input.order').length;
					
            var _newElem = $('<li id="menuitem-' + _id + '"><div>' + label + ' ( link )<span class="item-control"></span></div>'
                    + '<div class="menu_controls">'
                    + '<p>URL</p>'
                    + '<p><input type="text" name="reference[label-' + _id + ']" class="regular-text" value="' + url + '" /></p>'
                    + '<p>Label</p>'
                    + '<p><input type="text" name="menulabel[label-' + _id + ']" class="regular-text" value="' + label + '" />'
                    + '<p>Top Menu?</p>'
                    + '<p><input type="checkbox" name="topmenu[label-' + _id + ']" class="regular-text" value="Y" />'
                    + '<p><input type="hidden" name="order[label-' + _id + ']" class="order" value="' + _order + '" />'
                    + '<input type="hidden" name="menutype[label-' + _id + ']" value="<?php echo mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK ?>" />'
                    + '</p><p><a href="#" class="remove_menuitem">Remove</a></p></div></li>');
            _newElem.appendTo('ol.sortable');
            $('ol.sortable').trigger('sortupdate');

            $('#url-link').val('http://');
            $('#url-label').val('');
        });


        $('#add_page').click(function (e)
        {
            e.preventDefault();
            //first check if any page was checked or not
            var _selected = $('.select_page:checked');
            //console.log(_selected);
            if (_selected.length == 0)
                return false;

            _selected.each(function (i) {

                var label = $(this).next('label').text();
                var _id = menuCount++,
                        _order = $('input.order').length;
                _content_ref = $(this).val();
                var _newElem = $('<li id="menuitem-' + _id + '"><div>' + label + ' ( Page )<span class="item-control"></span></div>'
                        + '<div class="menu_controls">'
                        + '<p>Label</p>'
                        + '<p><input type="text" name="menulabel[label-' + _id + ']" class="regular-text" value="' + label + '" />'
                        + '<p>Top Menu?</p>'
                        + '<p><input type="checkbox" name="topmenu[label-' + _id + ']" class="regular-text" />'
                        + '<input type="hidden" name="menutype[label-' + _id + ']" value="<?php echo mainmenu\models\Mainmenu::MAINMENU_TYPE_PAGE ?>" />'
                        + '<input type="hidden" name="reference[label-' + _id + ']" value="' + _content_ref + '" />'
                        + '<p><input type="hidden" name="order[label-' + _id + ']" class="order" value="' + _order + '" />'
                        + '</p><p><a href="#" class="remove_menuitem">Remove</a></p></div></li>');
                _newElem.appendTo('ol.sortable');
                $('ol.sortable').trigger('sortupdate');
                $(this).attr({checked: false});
            });
        })

        $('#add_category').click(function (e) {
            e.preventDefault();
            var _selected = $('.select_category:checked');

            if (_selected.length == 0)
                return false;

            _selected.each(function (i) {

                var label = $(this).next('label').text();

                var _id = menuCount++,
                        _order = $('input.order').length;
                _content_ref = $(this).val();
                var _newElem = $('<li id="menuitem-' + _id + '"><div>' + label + ' ( Category )<span class="item-control"></span></div>'
                        + '<div class="menu_controls">'
                        + '<p>Label</p>'
                        + '<p><input type="text" name="menulabel[label-' + _id + ']" class="regular-text" value="' + label + '" />'
                        + '<p>Top Menu?</p>'
                        + '<p><input type="checkbox" name="topmenu[label-' + _id + ']" class="regular-text" value="Y" />'
                        + '<input type="hidden" name="menutype[label-' + _id + ']" value="<?php echo mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY ?>" />'
                        + '<input type="hidden" name="reference[label-' + _id + ']" value="' + _content_ref + '" />'
                        + '<p><input type="hidden" name="order[label-' + _id + ']" class="order" value="' + _order + '" />'
                        + '</p><p><a href="#" class="remove_menuitem">Remove</a></p></div></li>');
                _newElem.appendTo('ol.sortable');
                $('ol.sortable').trigger('sortupdate');
                $(this).attr({checked: false});
            });
        });
         $('#add_management').click(function (e) {
            e.preventDefault();
            var _selected = $('.select_management:checked');

            if (_selected.length == 0)
                return false;

            _selected.each(function (i) {

                var label = $(this).next('label').text();

                var _id = menuCount++,
                        _order = $('input.order').length;
                _content_ref = $(this).val();
                var _newElem = $('<li id="menuitem-' + _id + '"><div>' + label + ' ( Management )<span class="item-control"></span></div>'
                        + '<div class="menu_controls">'
                        + '<p>Label</p>'
                        + '<p><input type="text" name="menulabel[label-' + _id + ']" class="regular-text" value="' + label + '" />'
                        + '<p>Top Menu?</p>'
                        + '<p><input type="checkbox" name="topmenu[label-' + _id + ']" class="regular-text" value="Y" />'
                        + '<input type="hidden" name="menutype[label-' + _id + ']" value="<?php echo mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT ?>" />'
                        + '<input type="hidden" name="reference[label-' + _id + ']" value="' + _content_ref + '" />'
                        + '<p><input type="hidden" name="order[label-' + _id + ']" class="order" value="' + _order + '" />'
                        
                        + '</p><p><a href="#" class="remove_menuitem">Remove</a></p></div></li>');
                _newElem.appendTo('ol.sortable');
                $('ol.sortable').trigger('sortupdate');
                $(this).attr({checked: false});
            });
        });
        $('.remove_menuitem').live('click', function (e) {
            e.preventDefault();
            var really = confirm('Do you really want to remove this menu and all its children menus?');
            if (really)
            {
                var _remove = $(this).closest('li');

                //catch the ids to remove from database
                var _id = _remove.attr('id').split('-')[1];

                $('#update-main-menu').append('<input type="hidden" name="remove[]" value="' + _id + '" />');

                _remove.fadeOut('slow', null, function () {
                    $(this).remove();
                    $('ol.sortable').trigger('sortupdate');
                });
            } else
                return false;
        });

        

        $('#update-main-menu').bind('submit', function (e) {
            //e.preventDefault();
            var serial = $('ol.sortable').nestedSortable('toHierarchy');
            //var data = {'form_data':$(this).serialize(),'serial':serial};
            $('#sortable-order').val(JSONstring.make(serial));
        });

        $('#update-main-menu').find('input[type=text]').live('change', function () {
            $('ol.sortable').trigger('sortupdate');
        });

        $('.submenu-toggle').click(function () {
            var obj = $(this);
            var child = obj.closest('li').children('ol');

            //	console.log(label);
            //	console.log($(this).text());
            child.slideToggle('slow', function () {
                var label = child.is(':visible') ? 'Hide Submenus' : 'Show Submenus';
                obj.text(label);
            });

        });
    })

    function hideshowmenu() {
        $('#save_menu').show();
    }


    JSONstring = {
        compactOutput: false,
        includeProtos: false,
        includeFunctions: false,
        detectCirculars: true,
        restoreCirculars: true,
        make: function (arg, restore) {
            this.restore = restore;
            this.mem = [];
            this.pathMem = [];
            return this.toJsonStringArray(arg).join('');
        },
        toObject: function (x) {
            if (!this.cleaner) {
                try {
                    this.cleaner = new RegExp('^("(\\\\.|[^"\\\\\\n\\r])*?"|[,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t])+?$')
                }
                catch (a) {
                    this.cleaner = /^(true|false|null|\[.*\]|\{.*\}|".*"|\d+|\d+\.\d+)$/
                }
            }
            ;
            if (!this.cleaner.test(x)) {
                return {}
            }
            ;
            eval("this.myObj=" + x);
            if (!this.restoreCirculars || !alert) {
                return this.myObj
            }
            ;
            if (this.includeFunctions) {
                var x = this.myObj;
                for (var i in x) {
                    if (typeof x[i] == "string" && !x[i].indexOf("JSONincludedFunc:")) {
                        x[i] = x[i].substring(17);
                        eval("x[i]=" + x[i])
                    }
                }
            }
            ;
            this.restoreCode = [];
            this.make(this.myObj, true);
            var r = this.restoreCode.join(";") + ";";
            eval('r=r.replace(/\\W([0-9]{1,})(\\W)/g,"[$1]$2").replace(/\\.\\;/g,";")');
            eval(r);
            return this.myObj
        },
        toJsonStringArray: function (arg, out) {
            if (!out) {
                this.path = []
            }
            ;
            out = out || [];
            var u; // undefined
            switch (typeof arg) {
                case 'object':
                    this.lastObj = arg;
                    if (this.detectCirculars) {
                        var m = this.mem;
                        var n = this.pathMem;
                        for (var i = 0; i < m.length; i++) {
                            if (arg === m[i]) {
                                out.push('"JSONcircRef:' + n[i] + '"');
                                return out
                            }
                        }
                        ;
                        m.push(arg);
                        n.push(this.path.join("."));
                    }
                    ;
                    if (arg) {
                        if (arg.constructor == Array) {
                            out.push('[');
                            for (var i = 0; i < arg.length; ++i) {
                                this.path.push(i);
                                if (i > 0)
                                    out.push(',\n');
                                this.toJsonStringArray(arg[i], out);
                                this.path.pop();
                            }
                            out.push(']');
                            return out;
                        } else if (typeof arg.toString != 'undefined') {
                            out.push('{');
                            var first = true;
                            for (var i in arg) {
                                if (!this.includeProtos && arg[i] === arg.constructor.prototype[i]) {
                                    continue
                                }
                                ;
                                this.path.push(i);
                                var curr = out.length;
                                if (!first)
                                    out.push(this.compactOutput ? ',' : ',\n');
                                this.toJsonStringArray(i, out);
                                out.push(':');
                                this.toJsonStringArray(arg[i], out);
                                if (out[out.length - 1] == u)
                                    out.splice(curr, out.length - curr);
                                else
                                    first = false;
                                this.path.pop();
                            }
                            out.push('}');
                            return out;
                        }
                        return out;
                    }
                    out.push('null');
                    return out;
                case 'unknown':
                case 'undefined':
                case 'function':
                    if (!this.includeFunctions) {
                        out.push(u);
                        return out
                    }
                    ;
                    arg = "JSONincludedFunc:" + arg;
                    out.push('"');
                    var a = ['\\', '\\\\', '\n', '\\n', '\r', '\\r', '"', '\\"'];
                    arg += "";
                    for (var i = 0; i < 8; i += 2) {
                        arg = arg.split(a[i]).join(a[i + 1])
                    }
                    ;
                    out.push(arg);
                    out.push('"');
                    return out;
                case 'string':
                    if (this.restore && arg.indexOf("JSONcircRef:") == 0) {
                        this.restoreCode.push('this.myObj.' + this.path.join(".") + "=" + arg.split("JSONcircRef:").join("this.myObj."));
                    }
                    ;
                    out.push('"');
                    var a = ['\n', '\\n', '\r', '\\r', '"', '\\"'];
                    arg += "";
                    for (var i = 0; i < 6; i += 2) {
                        arg = arg.split(a[i]).join(a[i + 1])
                    }
                    ;
                    out.push(arg);
                    out.push('"');
                    return out;
                default:
                    out.push(String(arg));
                    return out;
            }
        }
    };
</script>