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
    let URL = ROOT + 'Rating/updateRating';
    // Use jQuery for AJAX to send the rating to the server
    $.ajax({
      type: 'POST',
      // Adjust the URL to your server-side script
      // url: 'http://localhost/MVC_Ecommerce/public/Rating/updateRating',
      url: URL,
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
  // Add to wishlist Button Click Event
  $('.add-to-list-btn').on('click', function () {
    const user_id = $(this).data('user-id');
    const product_id = $(this).data('product-id');
    const listcount = $('#listcount');
    let element = $(this);
    let URL = ROOT + 'wishlistController/addToList';
    // Use jQuery AJAX to send data to the server
    $.ajax({
      type: 'GET',
      url: URL,
      // url: 'http://localhost/MVC_Ecommerce/public/wishlistController/addToList',
      data: { user_id: user_id, product_id: product_id },
      dataType: 'json',
      success: function (response) {
        // Handle the response from the server if needed
        if (element.hasClass('singleShop')) {
          element.parent().addClass('d-none');
        }
        listcount.text(response);
      },
      error: function (xhr, textStatus, errorThrown) {
        // Log details of the AJAX error
        console.error('AJAX Error:', textStatus, errorThrown);
        // Log the response text
        console.log('Response Text:', xhr.responseText);
        // Handle errors if any
        console.error('Error adding to cart');
      }
    });
  });


  // Add to Cart Button Click Event
  $('.add-to-cart-btn').on('click', function () {
    const user_id = $(this).data('user-id');
    const product_id = $(this).data('product-id');
    const count = $('#cartcount');
    let element = $(this);
    let URL = ROOT + 'CartController/addToCart';
    // Use jQuery AJAX to send data to the server
    $.ajax({
      type: 'GET',
      url: URL,
      // url: 'http://localhost/MVC_Ecommerce/public/CartController/addToCart',
      data: { user_id: user_id, product_id: product_id },
      dataType: 'json',
      success: function (response) {
        // Handle the response from the server if needed
        if (count.hasClass('d-none')) {
          count.removeClass('d-none');
        }
        if (element.hasClass('singleShop')) {
          element.parent().addClass('d-none');
        }
        if (element.hasClass('buy')) {
          window.location.href = 'http://localhost/MVC_Ecommerce/public/CartController'; // Replace with the actual special URL
        }
        count.text(response.cartCount);
      },
      error: function (xhr, textStatus, errorThrown) {
        // Log details of the AJAX error
        console.error('AJAX Error:', textStatus, errorThrown);
        // Log the response text
        console.log('Response Text:', xhr.responseText);
        // Handle errors if any
        console.error('Error adding to cart');
      }
    });
  });


  // When the modal is shown
  $('#templatemo_list').on('shown.bs.modal', function () {
    // Attach a click event to the modal links
    $('.product-link').on('click', function (e) {
      // Allow the link to be clicked and navigate to its href
      e.stopPropagation();
    });

    // Attach a click event to the modal content
    $('.modal-content').on('click', function (e) {
      // Prevent the modal from being closed when clicking inside it
      e.stopPropagation();
    });
  });

  // When the modal is hidden
  $('#templatemo_list').on('hidden.bs.modal', function () {
    // Remove the click events when the modal is closed
    $('.product-link').off('click');
    $('.modal-content').off('click');
  });

  // Add to Cart Button Click Event
  $('.getcountry').on('click', function () {
    // Use jQuery AJAX to send data to the server
    $.ajax({
      url: 'https://restcountries.com/v2/all',
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        // Create CSV content
        let csvContent = 'name,alpha2Code\n';

        // Iterate over the array of countries
        response.forEach(country => {
          // Extract relevant data for each country
          const { name, alpha2Code } = country;

          // Append data to CSV content
          csvContent += `${name},${alpha2Code}\n`;
        });

        // Create a Blob
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Create a download link
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', 'country_data.csv');
        document.body.appendChild(link);

        // Trigger the download
        link.click();

        // Remove the link from the DOM
        document.body.removeChild(link);
      },
      error: function (xhr, textStatus, errorThrown) {
        // Log details of the AJAX error
        console.error('AJAX Error:', textStatus, errorThrown);
        // Log the response text
        console.log('Response Text:', xhr.responseText);
        // Handle errors if any
        console.error('Error adding to cart');
      }
    });
  });
  $('.getcities').on('click', function () {
    // Use jQuery AJAX to send data to the server
    $.ajax({
      url: 'https://countriesnow.space/api/v0.1/countries/states',
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log("response: ");
        console.log(response);
        // Create CSV content
        // let csvContent = 'name,alpha2Code\n';

        // // Iterate over the array of countries
        // response.forEach(country => {
        //   // Extract relevant data for each country
        //   const { name, alpha2Code } = country;

        //   // Append data to CSV content
        //   csvContent += `${name},${alpha2Code}\n`;
        // });

        // Create a Blob
        //   const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        //   // Create a download link
        //   const link = document.createElement('a');
        //   link.href = window.URL.createObjectURL(blob);
        //   link.setAttribute('download', 'country_data.csv');
        //   document.body.appendChild(link);

        //   // Trigger the download
        //   link.click();

        //   // Remove the link from the DOM
        //   document.body.removeChild(link);
        // },
        // error: function (xhr, textStatus, errorThrown) {
        //   // Log details of the AJAX error
        //   console.error('AJAX Error:', textStatus, errorThrown);
        //   // Log the response text
        //   console.log('Response Text:', xhr.responseText);
        //   // Handle errors if any
        //   console.error('Error adding to cart');
      }
    });
  });
  $('.export-to-csv').on('click', function () {
    // Use jQuery AJAX to send data to the server
    $.ajax({
      url: 'https://countriesnow.space/api/v0.1/countries', // Replace with your actual API endpoint
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        // Create CSV content
        let csvContent = 'code,country,city\n';

        // Iterate over the array of countries
        response.data.forEach(country => {
          // Extract country data
          const { country: countryName, iso2 } = country;

          // Iterate over the array of cities for each country
          country.cities.forEach(city => {
            // Append data to CSV content
            csvContent += `${iso2},${countryName},${city}\n`;
          });
        });

        // Create a Blob
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Create a download link
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', 'countries_and_cities.csv');
        document.body.appendChild(link);

        // Trigger the download
        link.click();

        // Remove the link from the DOM
        document.body.removeChild(link);
      },
      error: function (xhr, textStatus, errorThrown) {
        // Handle errors if any
        console.error('Error exporting to CSV');
      }
    });
  });

  $('#wishlist').on('click', function () {
    updateWishlist();

  });

  function updateWishlist () {
    let URL = ROOT + 'WishlistController/getList';
    $.ajax({
      type: 'GET',
      url: URL,
      // url: 'http://localhost/MVC_Ecommerce/public/WishlistController/getList',
      success: function (response) {
        // Update the modal content with the new data
        updateModalContent(response);
      },
      error: function (xhr, textStatus, errorThrown) {
        console.error('Error updating wishlist:', textStatus, errorThrown);
      }
    });



    function updateModalContent (updatedWishlistData) {
      // // Update the modal content here
      var modalContent = document.querySelector('#templatemo_list .items');

      // Clear existing content
      modalContent.innerHTML = '';

      // Add new content based on the updated wishlist data
      updatedWishlistData.forEach(function (item) {
        // Create and append elements based on your wishlist item structure
        var productDiv = document.createElement('div');
        productDiv.className = 'product modal-content';
        productDiv.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <img class="img-fluid mx-auto d-block image" src="${ROOT}${item.image_url}">
                </div>
                <div class="col-md-8">
                    <div class="info">
                        <div class="row">
                            <div class="col-md-5 product-name">
                                <div class="product-name">
                                    <a class="product-link" href="${ROOT}shopsingle?id=${item.product_id}">${item.name}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

        modalContent.appendChild(productDiv);
      });
    }

  }
});
// End roduct detai