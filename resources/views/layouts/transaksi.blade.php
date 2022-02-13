<!DOCTYPE html>
<html>
<head>
	<title>Weargloeshoes | Status Pembelian</title>
	<link rel="icon" href="{{ asset('/img/logo2.png') }}" />
	<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<style>
.joss [type="number"] { border: none } { background-color : transparent }

{box-sizing: border-box;}
.tek {
  border: none;
  display: inline;
  font-family: inherit;
  font-size: inherit;
  padding: none;
  width: auto;
}
</style>
</head>
<body>

    @yield('content')
</body>
{{-- <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>   --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      {{-- Tinymce --}}

      <script src="https://cdn.tiny.cloud/1/335cnq2eqfigigqkkhiors0zhjyb1261kurmdgx5in5f3os4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
      });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <script>
      tinymce.init({
      selector: '#mytextarea'
      });
      
          function addCommas(nStr) {
              nStr += '';
              var x = nStr.split('.');
              var x1 = x[0];
              var x2 = x.length > 1 ? '.' + x[1] : '';
              var rgx = /(\d+)(\d{3})/;
              while (rgx.test(x1)) {
                  x1 = x1.replace(rgx, '$1' + ',' + '$2');
              }
              return x1 + x2;
          }
          $( document ).ready(function() {
              var temp = $('#PRICE').val() * $('#QTY').val();
              $('#TOTAL').html(addCommas(temp));
              $('#total_input').val($('#PRICE').val() * $('#QTY').val());
              // $('#label_input').val($('#PRICE').val() * $('#QTY').val());
              
          });
  
          $('.btn-plus, .btn-minus').on('click', function(e) {
              const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
              const input = $(e.target).closest('.input-group').find('input');
              if (input.is('input')) {
              input[0][isNegative ? 'stepDown' : 'stepUp']()
              }
              var x = document.getElementById("QTY").value;
              var y = document.getElementById("PRICE").value;
              var multi = x * y;
              
              $('#total_input').val($('#PRICE').val() * $('#QTY').val());
              $('#TOTAL').html(addCommas(multi));
  
          });
      </script>
</html>
