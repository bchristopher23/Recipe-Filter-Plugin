jQuery(document).ready(function(){

// init Isotope
var $container = jQuery('#recipes_container').isotope({
  itemSelector: '.recipe',
  layoutMode: 'fitRows'
});

var $output = jQuery('#output');

// filter with selects and checkboxes
var $checkboxes = jQuery('#recipe_tax_filter input');

$checkboxes.change( function() {
  // map input values to an array
  var inclusives = [];
  // inclusive filters from checkboxes
  $checkboxes.each( function( i, elem ) {
    // if checkbox, use value if checked
    if ( elem.checked ) {
      inclusives.push( elem.value );
    }
  });

  // combine inclusive filters
  var filterValue = inclusives.length ? inclusives.join(', ') : '*';

  $output.text( filterValue );
  $container.isotope({ filter: filterValue })
});


// function createItems() {

//   var $items;
//   // loop over colors, sizes, prices
//   // create one item for each
//   for (  var i=0; i < colors.length; i++ ) {
//     for ( var j=0; j < sizes.length; j++ ) {
//       for ( var k=0; k < prices.length; k++ ) {
//         var color = colors[i];
//         var size = sizes[j];
//         var price = prices[k];
//         var $item = $('<div />', {
//           'class': 'item ' + color + ' ' + size + ' price' + price
//         });
//         $item.append( '<p>' + size + '</p><p>$' + price + '</p>');
//         // add to items
//         $items = $items ? $items.add( $item ) : $item;
//       }
//     } 
//   }

//   $items.appendTo( jQuery('#recipes_container') );

// }

// jQuery('.checkbox-custom-label').click(function(){
//   console.log('clicked');
//   jQuery(this).prev('input').prop('checked', function(i, v) { return !v; });
// });

});