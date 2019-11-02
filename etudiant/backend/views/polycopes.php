<!-- alert error -->
<div class="container" style="display: none;" id="ErrorFile">
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Erreur!</strong> Polycope n'a pas été posté.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
<!-- alert success -->
<div class="container" style="display: none;" id="SuccessFile">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>C'est bon!</strong> Votre polycope est bien poster.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>

<!-- post form -->
<form class="card my-3" id="polyForm">
  <div class="card-body">
    <div class="card-title">
      <h4>Publier polycope</h4>
    </div>
    <div class="form-group custom-file">
      <input type="file" accept="application/pdf" class="custom-file-input" id="customFile" required>
      <label class="custom-file-label" for="customFile">Polycope</label>
    </div>

    <div class="form-group">
      <label for="descr">Description</label>
      <textarea class="form-control" id="descr" rows="3" required></textarea>
    </div>
    <button class="btn btn-primary">Publier</button>
  </div>
</form>

<!-- checking if there is any polycopes -->
<?php if ($data) : ?>

  <!-- data exists -->
  <?php foreach($data as $row) : ?>
    <!-- card with download button -->
    <div class="card my-3">
      <div class="card-body">
        <div class="card-title">
          <img class="rounded-circle" src="<?php echo '../files/profile/'.$row->image_e ?>" width="40px" height="40px">
          <span class="h5"><?php echo $row->nom_e.' '.$row->prenom_e; ?></span>
          <h6 class="float-right text-muted"><?php echo $row->date_inscr; ?></h6>
        </div>
        <p class="card-text">
          <?php echo $row->description; ?>
        </p>
        <?php 
          $filename = $row->lien;

          $ext = explode('.', $filename);
          $finalext = strtolower(end($ext));
          if($finalext === "jpg" || $finalext === "png" || $finalext === "jpeg"):
         ?>
        <img class="card-img" src="../files/postes/<?php echo $row->lien ?>">

        <?php else: ?>
          <a href="../files/postes/<?php echo $row->lien ?>" class="btn btn-primary" download>Telecharger</a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach ; ?>

<?php else : ?>

  <!-- no data to show -->
  <h2>No data to show</h2>

<?php endif ; ?>

<script type="text/javascript">
  $( "#polyForm" ).submit(function( event ) {
    // prevent default submition
    event.preventDefault();

    var name = document.getElementById("customFile").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) 
    {
     $("#ErrorFile").show();
     return;
    }

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("customFile").files[0]);
    var f = document.getElementById("customFile").files[0];
    var fsize = f.size||f.fileSize; //files size in bytes
    if(fsize > 10000000)
    {
     $("#ErrorImg").show();
    }else{
      // ajax
      form_data.append("submit", 1);
      form_data.append("Page", "polycopes");
      form_data.append("descr", $("#descr").val());
      form_data.append("file", document.getElementById('customFile').files[0]);

      $.ajax({
       url:"backend/work.php",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
        // loading screen
        $("#content-loading").show();
       },   
       success:function(data)
       {
        if(data === "inserted"){
          loadContent("polycopes");
          $("#SuccessFile").show();
          
        }else{
          $("#ErrorFile").show();
        }
        $("#content-loading").hide();
       }
      });

    }

  });

</script>