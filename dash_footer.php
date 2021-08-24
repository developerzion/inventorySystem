    <script src="tablejs/jquery-2.0.3.min.js"></script>
    <script src="tablejs/jquery.dataTables.js"></script>
    <script src="tablejs/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="calc_script.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

          $(".print_record").on("click", function(){
            $('.printable').slideDown().delay(5000).slideUp().delay();
          });
            $('.notify').slideDown().delay(2000).slideUp().delay(2000);
            $('.notij').slideDown().delay(2000).slideUp().delay(1000);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){            
            $(".digitOnly").keypress(function(event){
               if(String.fromCharCode(event.keyCode).match(/[^0-9]/g)) return false;
            });
        });
    </script>

    <script type="text/javascript">
      function cart(id)
      {
        var name=document.getElementById(id+"_name").value;
        var qty=document.getElementById(id+"_qty").value;
        var price=document.getElementById(id+"_price").value;
      
        $.ajax({
          type:'post',
          url:'store_cart.php',
          data:{
            item_name:name,
            item_qty:qty,
            item_price:price
          }
        });
      }
      $.ajax({
        type:'post',
        url:'store_cart.php',
        data:{
          showcart:"cart"
        },
        success:function(response) {
          $("#getTable").html(response);
        }
      }); 
    </script>

    <script>
      $(document).ready(function () { $('#dataTables-example').dataTable(); }); 
    </script>