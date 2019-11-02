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

<form class="bg-light p-3" id="newmsg">
  <div class="form-group">
    <label for="to">To</label>
    <input type="text" class="form-control" id="to" placeholder="Matricule / Username" required>
  </div>
  <div class="form-group">
    <label for="subject">Sujet</label>
    <input type="text" class="form-control" id="subject" placeholder="Sujet" required>
  </div>
  <div class="form-group">
    <label for="msg-content">Example textarea</label>
    <textarea class="form-control" id="msg-content" rows="5" required></textarea>
  </div>
  <div class="form-group">
    <button class="btn btn-primary">Envoyer</button>
  </div>
</form>


<script type="text/javascript">
  $( "#newmsg" ).submit(function( event ) {
    // prevent default submition
    event.preventDefault();

    // ajax
    $.ajax({
        type: 'POST',
        url: 'backend/work.php',
        data: { Page: 'newmsg', submit: 1, msg: $("#msg-content").val().trim(),
                to: $("#to").val(), subject: $("#subject").val()},
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

          $("#subject").val("")
          $("#to").val("")
          $("#msg").val("");
        }else{
          $("#error").show();
        }
        $("#content-loading").hide();
     }
    });
  });
</script>