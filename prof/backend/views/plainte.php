<!-- Form -->
<form class="container bg-light p-3 my-4" id="plainte">

  <!-- alert success -->
  <div class="container" style="display: none;" id="success">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>C'est bon!</strong> Votre message a été bien envoyé.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>

  <!-- alert error -->
  <div class="container" style="display: none;" id="error">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Erreur!</strong> Votre Message n'a pas été envoyé.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Message de Plainte</label>
    <textarea class="form-control" id="msg" rows="6" name="msg" required></textarea>
  </div>

  <div class="form-group">
    <button class="btn btn-primary">Submit</button>
  </div>
</form>

<script type="text/javascript">
  $( "#plainte" ).submit(function( event ) {
    // prevent default submition
    event.preventDefault();

    //checking if the msg is empty
    if ($("#msg").val().trim().length == 0) {
      $("#error").show();
      return;
    }
    // ajax
    $.ajax({
        type: 'POST',
        url: 'backend/work.php',
        data: { Page: 'plainte', submit: 1, msg: $("#msg").val().trim()},
        beforeSend:function(){
          // set the loading screen
          $("#content-loading").show();
        },   
     error: function(){
      alert("error no connection");
      $("#content-loading").hide();
     },
     success:function(data)
     {
        if(data === "inserted"){
          $("#error").hide();
          $("#success").show();
          $("#msg").val("");
        }else{
          $("#error").show();
        }
        $("#content-loading").hide();
     }
    });
  });
</script>