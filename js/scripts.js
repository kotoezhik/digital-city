$(function () {
  /* Yandex maps */
  var myMap;

  function init() {

    var myPlacemark,
      MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div style="border: 2px solid lightblue; font-weight: bold; width: 190px; display: inline-block; left: 10px; position: relative; font-size: 15px; height: 23px; background-color: rgba(255, 255, 255, 0.75); text-align: center; line-height: 19px; top: -4px; z-index: -1; border-radius: 8px; color: #222;">$[properties.iconContent]</div>'
      );

    myMap = new ymaps.Map(
        'ya_map', {
          center: [56.313, 44.0325],
          zoom: 15,
          scroll: false
        }),

      myPlacemark = new ymaps.Placemark([56.311331, 44.030088], {
        balloonContentBody: "<div class='yamap-card'><span class='yamap-card__address'>Нижний Новгород,<br> Большая Печерская, 23</span><a class='yamap-card__phone' href='tel:+78314555515'>+7 (831) 455-55-15</a> <a class='yamap-card__email' href='mailto:info@digital-city.ru'>info@digital-city.ru</a></div>",
        balloonContentSize: [290, 180],
        balloonShadow: true,
        iconContent: 'ул. Полтавская, д. 32 ',

        hideIconOnBalloonOpen: true
      }, {
        iconContentLayout: MyIconContentLayout
      });

    myMap.events.add('click', function () {
      myMap.balloon.close();
    });

    myMap.behaviors.disable('scrollZoom');
    myMap.geoObjects.add(myPlacemark);
  }

  ymaps.ready(init);
  /* end Yandex maps */

  /* File upload show filename */
  $(".file-upload input[type=file]").change(function () {
    var filename = $(this).val().replace(/.*\\/, "");
    $("#filename").text(filename);
    $("#filename").css('margin-right', '30px');
  });

  /* end File upload show filename */

  /* AJAX form submit */
  $("#form-callback").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var file_data = $('#msg-file').prop('files')[0];    
    formData.append('file', file_data);
//    var formData = $(this).serialize();
    console.info(formData);
    $.ajax({
      url: '/callback.php',
      type: 'POST',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      dataType: 'text',
      success: function (data) {
        $('.form-status').html(data);
      }
    });
  });

});