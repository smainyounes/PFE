<?php if($data): ?>

  <?php if($_POST['stat'] === "r"): ?>
    
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

    <div class="container p-2">
      <span class="text-muted float-right"><?php echo $data->date_sent; ?></span>
      <?php if($data->who_s === "p"): ?>
        <h4>De PROF: <?php echo $data->nom_p; ?></h4>
        <span style="display: none;" id="to"> <?php echo $data->user_name; ?> </span>
      <?php elseif($data->who_s === "e"): ?>
        <h4>De : <?php echo $data->nom_e.' '.$data->prenom_e; ?></h4>
        <span style="display: none;" id="to"> <?php echo $data->matricule; ?> </span>
      <?php endif; ?>
      <h5>Sujet : <?php echo $data->sujet; ?></h5>
      <p class="border p-2">
        <?php echo $data->contenu; ?>
      </p>
      <form class="mt-5" id="reponse">
        <div class="form-group">
          <label for="msg-content">Votre Reponse</label>
          <textarea class="form-control" id="msg-content" rows="5"></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary">Repondre</button>
        </div>
      </form>

      <script type="text/javascript">
        $( "#reponse" ).submit(function() {
          // prevent default submition
          event.preventDefault();

          // ajax
          $.ajax({
              type: 'POST',
              url: 'backend/work.php',
              data: { Page: 'newmsg', submit: 1, msg: $("#msg-content").val().trim(),
                      to: $("#to").text().trim(), subject: "<?php echo 'RE '.$data->sujet ?>"},
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

    </div>
  <?php elseif($_POST['stat'] === "s"): ?>
    <div class="container p-2">
      <span class="text-muted float-right"><?php echo $data->date_sent; ?></span>
      <?php if($data->who_r === "p"): ?>
        <h4>à PROF: <?php echo $data->nom_p; ?></h4>
      <?php elseif($data->who_r === "e"): ?>
        <h4>à : <?php echo $data->nom_e.' '.$data->prenom_e; ?></h4>
      <?php endif; ?>
      <h5>Sujet : <?php echo $data->sujet; ?></h5>
      <p class="border p-2">
        <?php echo $data->contenu; ?>
      </p>

    </div>
  <?php endif; ?>
  
<?php else: ?>
  <h3>Erreur message n'existe pas</h3>
<?php endif; ?>
