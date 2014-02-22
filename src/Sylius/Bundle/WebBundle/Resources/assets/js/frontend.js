/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function ( $ ) {
    'use strict';

    $(document).ready(function() {

        $('.sylius-different-billing-address-trigger').click(function() {
            $('#sylius-billing-address-container').toggleClass('hidden');
        });

        var sidebar = new Sidebar();
        sidebar.init();

    });

})( jQuery );

var Sidebar = function() {
    this.$sidebar = $('#sidebar');
}
    Sidebar.prototype.init = function() {
        this.$sidebar.find('li.expandable a.expandable').on('click', function(e) {
            e.preventDefault();

            var $parent = $(this).parent('li.expandable');
            var $target = $(this).siblings('.hidden-item');
            console.log($target);

            if ($parent.hasClass('collapsed')) {
                $target
                    .slideDown(
                        'fast',
                        function() {
                            $parent
                                .removeClass('collapsed')
                                .addClass('expanded');
                        }
                    );
            } else {
                $target
                    .slideUp(
                        'fast',
                        function() {
                            $parent
                                .removeClass('expanded')
                                .addClass('collapsed');
                        }
                    );
            }
        });
    };