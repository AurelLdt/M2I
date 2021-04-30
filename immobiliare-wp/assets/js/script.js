// On crée un "alias" sur jQuery
var $ = jQuery;

// Démarre le carousel
$('#carousel').slick();

// Initialise isotope
$('.properties').isotope({
    // options
    itemSelector: '.col-lg-3',
    layoutMode: 'fitRows'
});

// Au clic, on doit faire
// $('.properties').isotope({ filter: '.filter-136' });

// En Vanilla JS
/*let buttons = document.getElementsByClassName('filter-city');

for (let button of buttons) {
    button.addEventListener('click', function (e) {
        console.log(this.dataset.city);
    });
}*/

// En jQuery
$('.filter-city').click(function () {
    let city = $(this).data('city');

    // On va filtrer par ville avec Isotope
    $('.properties').isotope({ filter: city });
    console.log(city);
});
