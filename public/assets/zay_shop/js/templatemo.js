/*

TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

*/

'use strict';
$(document).ready(function () {

  // Accordion
  var all_panels = $('.templatemo-accordion > li > ul').hide();

  $('.templatemo-accordion > li > a').click(function () {
    var target = $(this).next();
    if (!target.hasClass('active')) {
      all_panels.removeClass('active').slideUp();
      target.addClass('active').slideDown();
    }
    return false;
  });
  // End accordion

  // Product detail
  $('.product-links-wap a').click(function () {
    var this_src = $(this).children('img').attr('src');
    $('#product-detail').attr('src', this_src);
    return false;
  });
  $('#btn-minus').click(function () {
    var val = $("#var-value").html();
    val = (val == '1') ? val : val - 1;
    $("#var-value").html(val);
    $("#product-quanity").val(val);
    return false;
  });
  $('#btn-plus').click(function () {
    var val = $("#var-value").html();
    val++;
    $("#var-value").html(val);
    $("#product-quanity").val(val);
    return false;
  });
  $('.btn-size').click(function () {
    var this_val = $(this).html();
    $("#product-size").val(this_val);
    $(".btn-size").removeClass('btn-secondary');
    $(".btn-size").addClass('btn-success');
    $(this).removeClass('btn-success');
    $(this).addClass('btn-secondary');
    return false;
  });
  // rating System Start

  const ratingContainer = $('#ratingContainer');
  const progressBar = ratingContainer.find('.rating-bg');

  ratingContainer.on('mouseover', function (event) {
    const boundingBox = ratingContainer[0].getBoundingClientRect();
    const starWidth = boundingBox.width / 5;
    const hoveredStar = Math.floor((event.clientX - boundingBox.left) / starWidth) + 1;

    progressBar.val(hoveredStar);
  });

  ratingContainer.on('mouseout', function () {
    progressBar.value = initialAverageRating;
  });

  ratingContainer.on('click', function () {
    const ratingValue = progressBar.val();
    const user_id = 14;
    const product_id = 2;

    // Use jQuery for AJAX to send the rating to the server
    $.ajax({
      type: 'POST',
      // Adjust the URL to your server-side script
      url: 'http://localhost/MVC_Ecommerce/public/Rating/updateRating',
      data: JSON.stringify({
        newRating: ratingValue,
        user_id: user_id,
        product_id: product_id
      }),
      contentType: 'application/json',
      success: function (response) {
        // Handle the response from the server if needed
        console.log("response: ");
        console.log(response);
        // Update the UI or perform any other actions
      },
      error: function () {
        // Handle errors if any
        console.error('Error submitting rating');
      }
    });
  });
});
// End roduct detai