/**
 * Custom js for Kinderbook
 */

(function($) {

    // Removes the flash message after 3 seconds:
    setTimeout(function() {
        $('#status').fadeOut('fast');
    }, 3000);

})(jQuery);

// Change the color on kids card, based on when they arrive to preschool. If the user if an admin!
if(user[0] === 1 || user[0] === 2) {
    document.body.addEventListener('click', e => {

        const target = e.target.parentElement.classList;

        if(target.contains('blue')) {
            target.add('green');
            target.remove('blue');
        } else if (target.contains('green')) {
            target.add('blue');
            target.remove('green');
        }
    });
}
