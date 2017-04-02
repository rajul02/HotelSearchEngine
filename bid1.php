<?php include 'header.php';?>

<?php
   
   
    include_once 'dbConnect.php';


     $id = $_GET['id'];
    //echo $id;

	$funobj = new dbFunction($conn);

	$data = $funobj->productDetail($id);
//	print_r($data);

 // $item = $funobj->bidding($id);
  $bdng = $funobj->bdngValue($id);
 // echo $bdng['MAX(bid_value)'];
  if(!isset($bdng['MAX(bid_value)']))
  {
   

    $bdng['MAX(bid_value)'] = $data['price'];
  }

  if(isset($_POST['bid'])){
    $bid_value = $_POST['bidding_value'];
    $item = $funobj->bidding($id ,$bid_value);
  }

	
 

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bid1.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $('').click(function(){
          $.ajax({
                url: 'dbFunction.php',
                data: {bid_value: $('#bid_value').val()},
                success: function (result) {
                    alert(result)
                }
            });
       });
    });
    </script>
</head>

<div class="container-fluid">
	
	<div class="col-md-6" style="color: white;">
		<div class="product-desc">
			<h1><?php echo $data['item_title'];?></h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rhoncus nibh ut enim imperdiet luctus. Proin lorem lorem, gravida eget dictum sit amet, pharetra eu orci. Morbi auctor erat ac laoreet vehicula. In hac habitasse platea dictumst. Donec ac lorem elementum, malesuada arcu nec, congue erat. Morbi eu rutrum massa, eget varius ex. Nulla dolor mauris, pretium sollicitudin volutpat quis, dignissim non neque. Mauris eget massa non elit tristique sollicitudin convallis eu metus. Suspendisse scelerisque nisl at consectetur ullamcorper. Nulla rhoncus nunc vel eleifend ullamcorper. Sed velit felis, vestibulum sed rutrum ac, viverra nec turpis. Mauris et consectetur dolor.

				</p>
				<div class="bidding">

					<h3>Initial Price:<?php echo $data['price'];?></h3>
          <h3>Current Bidding Value:<?php echo $bdng['MAX(bid_value)'];?></h3>
					<br><br>
					  <div class="center">
    
      
      </p><form method="post" action="<?php header('bid1.php');?>">
      <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="bidding_value">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="bidding_value" id="bid_value" class="form-control input-number" value="<?php echo $bdng['MAX(bid_value)'];?>" min="<?php echo $bdng['MAX(bid_value)'];?>" max="10000000">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="bidding_value">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
	<p></p>
</div>
  <div>
    <center>
    <input type="submit" name="bid" value="Submit" id="submit" />
  </center>
</form>
  </div>
		</div>
	</div>

  </div>
	<div class="col-md-6">
		<div class="item">
			<img src="uploads/<?php echo $data['item_image']; ?>.jpg" height="500px">
		</div>
	</div>





<script type="text/javascript">
  $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 5).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 5).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 
                 return;
        }
        
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

</script>









<?php include 'footer.php'; ?>