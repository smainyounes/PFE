
<!-- card without picture -->
<!-- checking if there is any emploi -->
<?php if ($data) : ?>

  <!-- data exists -->
  <?php foreach($data as $row) : $v=0; 
    if ($v==0) {
    ?>
  <h3 style="text-align: center;" class="py-2">Emploi de temp</h3>
  <div class="card text-center my-3" style="">
  
  <div class="" >
   <img class="img-fluid" src="<?php echo 'backend/files/emploi/'.$row->lien_e ?>" alt="image">
    
  </div>
  <div class="card-footer text-muted justify-content-right">
  <a href="<?php echo 'backend/files/emploi/'.$row->lien_e ?>" class="btn btn-outline-primary float-right mx-4" download>Telecharger</a>
    
    <!-- <a href="#" class="btn btn-primary">Telecharger</a> -->
  </div>
</div>
<?php 
}$v++;
endforeach ; ?>

<?php else : ?>

  <!-- no data to show -->
  <h2>No data to show</h2>

<?php endif ; ?>
<h3 style="text-align: center;"  class="py-2">Mes publication</h3>
<?php if ($data) : ?>

  <!-- data exists -->
  <?php foreach($data as $row) : ?>
<!-- card without picture -->
<!-- checking if there is any polycopes -->
<?php if($row->lien != NULL): ?>
<div class="card my-3">
  <div class="card-body">
    <div class="card-title">
      <img class="rounded-circle" src="" width="40px" height="40px">
      <span class="h5">Poster Name</span>
      <h6 class="float-right text-muted"><?php echo $row->date_inscr; ?></h6>
    </div>
    <p class="card-text">
    <?php echo $row->description; ?>
    </p>
    <footer class="blockquote-footer"><?php echo $row->type; ?></footer>
   
      <a href="<?php echo 'backend/files/postes/'.$row->lien ?>" class="btn btn-outline-primary float-right mx-4" download>Telecharger</a>
    
   
    <form >
      <button type="submit" id="btn_sup" onclick="sup(<?php echo $row->id?>);" name="" class="btn btn-danger float-right" >Supprimer</button>
    </form>
    
  </div>
</div>

<?php endif; ?>
<?php endforeach ; ?>

<?php else : ?>

  <!-- no data to show -->
  <h2>No data to show</h2>

<?php endif ; ?>
<script>
 function sup(e){
  //  alert(e);
  var form_data = new FormData();
    form_data.append("submit", 1);
      form_data.append("Page", "sup");
      form_data.append("id",e );
      $.ajax({
       url:"backend/work.php",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
        // loading screen

       },   
       success:function(data)
       {
        if(data === "inserted"){
          // alert("done");
          // ani1();
        }else{
          // alert("sorry !");
          // ani2();
        }
       }
      });
			  }
      



</script>