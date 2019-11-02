    <!-- alert success -->
    <div class="container" style="display: none;" id="SuccessImg">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>C'est bon!</strong> Votre image de profile a été changer.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
        <!-- alert success -->
    <div class="container" style="display: none;" id="SuccessPass">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>C'est bon!</strong> Votre mot de passe a été changer.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
        <!-- alert error -->
    <div class="container" style="display: none;" id="ErrorImg">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur!</strong> Votre image n'a pas été changer.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <!-- alert error -->
    <div class="container" style="display: none;" id="ErrorPass">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur!</strong> Votre mote de passe n'a pas été changer.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>

<!-- main settings -->
<div class="container-fluid my-5">

    <!-- change picture -->
    <div class="row mx-auto text-center">
      <div class="col p-0">
        <img class="rounded-circle" id="blah" src="<?php echo '../files/profile/'. $data->image_e ?>" width="200" height="200">
      </div>
      <div class="col my-auto">
        <input type="file" name="" hidden id="picfile">
        <button class="btn btn-primary mt-3" onclick="$('#picfile').click()">Changer</button>
        <button class="btn btn-outline-success mt-3" id="save" onclick="changepic()" style="display: none;">Enregistrer</button>
      </div>
    </div>
    <hr>
  <form class="text-center" id="password">


    <!-- change password -->
    <h3 class="text-center">Change Password</h3>
    <div class="form-group w-75 text-center mx-auto">
      <input type="password" id="oldpass" class="form-control text-center my-2" placeholder="Old Password" required>
      <input type="password" id="pass1" class="form-control text-center my-2" placeholder="New Password" required>
      <input type="password" id="pass2" class="form-control text-center my-2" placeholder="Confirmer mot de passe" required>

    </div>
    <button class="btn btn-primary">Confirmer</button>
  </form>
</div>

<script type="text/javascript">
  // load preview pic before upload
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }


  // settings save button
  $('#picfile').change(function(){
    if($('#picfile').get(0).files.length === 0){
      $('#save').hide();
    }else{
      $('#save').show();
      // loadpic
      readURL(this);
    }      
  });

  //change picture
  function changepic(){
    var name = document.getElementById("picfile").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
     $("#ErrorImg").show();
     return;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("picfile").files[0]);
    var f = document.getElementById("picfile").files[0];
    var fsize = f.size||f.fileSize; //files size in bytes
    if(fsize > 2000000)
    {
     $("#ErrorImg").show();
    }
    else{
      form_data.append("submit", 1);
      form_data.append("img", 1);
      form_data.append("Page", "settings");
      form_data.append("file", document.getElementById('picfile').files[0]);
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
          LoadUserInfo();
          $("#SuccessImg").show();
        }else{
          $("#ErrorImg").show();
        }
        $("#content-loading").hide();
       }
      });
    }
  } 

  // change password
  $( "#password" ).submit(function( event ){
    // prevent default submition
    event.preventDefault();

    // ajax
    $.ajax({
        type: 'POST',
        url: 'backend/work.php',
        data: { Page:'settings',
            submit: 1,
            pass: 1,
            old: $("#oldpass").val(),
            new1: $("#pass1").val(),
            new2: $("#pass2").val() },
        beforeSend:function(){
          // activate loading screen
          $("#content-loading").show();
        }, 
        success: function(data) {
          alert(data);
          if(data === "inserted"){
            $("#SuccessPass").show();
          }else{
            $("#ErrorPass").show();
          }
          $("#content-loading").hide();
        }
    });
  });
</script>