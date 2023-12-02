$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


// Upload file 
$('#upload').change(function (){
      const form = new FormData();
      form.append('file', $(this)[0].files[0]);
  
      $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          dataType: 'JSON',
          data: form,
          url: '/admin/upload/service',
          success: function (result) {
              if (result.error == false) {
                  $('#img_show').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:180px;"></a>')
                  $('#img_old').css('display', 'none')
                  $('#hinhanh').val(result.url)
              }
              else {
                  alert('Upload file lỗi')
              }
          }
      })
  });


  // Upload file 
$('#upload1').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function (result) {
            if (result.error === false) {
                $('#img_show1').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:180px;"></a>')
                $('#img_old1').css('display', 'none')
                $('#hinhanh1').val(result.url)
            }
            else {
                alert('Upload file lỗi')
            }
        }
    })
});

 // Upload file 
 $('#upload2').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function (result) {
            if (result.error === false) {
                $('#img_show2').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:180px;"></a>')
                $('#img_old2').css('display', 'none')
                $('#hinhanh2').val(result.url)
            }
            else {
                alert('Upload file lỗi')
            }
        }
    })
});
 // Upload file 
 $('#upload3').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function (result) {
            if (result.error === false) {
                $('#img_show3').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:180px;"></a>')
                $('#img_old3').css('display', 'none')
                $('#hinhanh3').val(result.url)
            }
            else {
                alert('Upload file lỗi')
            }
        }
    })
});
// Upload file 
$('#upload4').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function (result) {
            if (result.error == false) {
                $('#img_show4').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:200px;height:110px;"></a>')
                $('#img_old4').css('display', 'none')
                $('#hinhanh4').val(result.url)
            }
            else {
                alert('Upload file lỗi')
            }
        }
    })
});

// Upload file 
$('#upload5').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function (result) {
            if (result.error == false) {
                $('#img_show5').html('<a href="'+ result.url +'" target="_blank"><img src="'+ result.url +'" style="width:13 0px;height:190px;"></a>')
                $('#img_old5').css('display', 'none')
                $('#hinhanh5').val(result.url)
            }
            else {
                alert('Upload file lỗi')
            }
        }
    })
});
