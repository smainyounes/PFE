

<form id="affichage"  class="was-validated">
<div class="accordion my-3" id="accordionExample">
  <div class="card crd" >
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link bl-1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="">
          Année:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show " aria-labelledby="heading" >
      <div class="">
          
            <div class="row justify-content-center">
              <div class="inputGroup col-md-6 col-lg-3">
                <input id="radio1" value="2" class="ra2" checked onclick="show_hide(0);" name="annee" type="radio"/>
                <label for="radio1">2eme Licence</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3">
                <input id="radio2" value="3" name="annee" onclick="show_hide(1);" type="radio"/>
                <label for="radio2">3eme Licence</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3">
                <input id="radio3" name="annee" value="4" onclick="show_hide(2);" type="radio"/>
                <label for="radio3">1er Master</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3">
                <input id="radio4" name="annee" value="5" onclick="show_hide(2);" type="radio"/>
                <label for="radio4">2eme Master</label>
              </div>
            </div>
          
        
      </div>
    </div>
  </div>
  <div class="card crd">
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Spécialité:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse show" aria-labelledby="heading" >
      <div class="">
          
            <div class="row justify-content-center">
              <div class="inputGroup col-md-6 col-lg-3"  id="r1">
                <input id="radio11" class="r2"  name="spec" value="Informatique" type="radio"/>
                <label for="radio11">Informatique</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3" id="r2">
                <input id="radio5" class="r3" name="spec" value="SIQ" type="radio"/>
                <label for="radio5">SIQ</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3" id="r3">
                <input id="radio6" class="r3" name="spec" value="ISIL" type="radio"/>
                <label for="radio6">ISIL</label>
              </div>
              
              <div class="inputGroup col-md-6 col-lg-3"  id="r4">
                <input id="radio7" class="r3" name="spec" value="IL" type="radio"/>
                <label for="radio7">IL</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3" id="r5">
                <input id="radio8" class="r3" name="spec" value="SIR" type="radio"/>
                <label for="radio8">SIR</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3" id="r6">
                <input id="radio9" class="r3" name="spec" value="SSI" type="radio"/>
                <label for="radio9">SSI</label>
              </div>
              <div class="inputGroup col-md-6 col-lg-3" id="r7">
                <input id="radio10" class="r3" name="spec" value="TAL" type="radio"/>
                <label for="radio10">TAL</label>
              </div>
            </div>
          
        
      </div>
    </div>
  </div>
   <div class="card crd">
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed bl-3" type="button" data-toggle="collapse" data-target="#collapseff" aria-expanded="false" aria-controls="collapseff">
          Module:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>
    <div id="collapseff" class="collapse show" aria-labelledby="heading" >
      <div class="card-body">
       
         <div class="form-group">
             <select id="modselect" class="custom-select" required>
             <?php if ($data) : ?>
             <?php foreach($data as $row) : ?>
               <option ><?php echo $row->nom_module; ?></option>
               <?php endforeach ; ?>
               <?php endif ; ?>
             </select>
             <div class="invalid-feedback">Example invalid custom select feedback</div>
           </div>
       
      </div>
    </div>
  </div> 
  <div class="card crd" >
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed bl-4" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Section:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse show" aria-labelledby="heading" >
      <div class="">
       
          <div class="row justify-content-center">
            <div class="inputGroup  col-md-12 col-lg-3" id="seca">
              <input id="option1" value="A" name="section" checked type="radio"/>
              <label for="option1">Section A</label>
            </div>
            
            <div class="inputGroup  col-md-12 col-lg-3" id="secb">
              <input id="option2" value="B" name="section" type="radio"/>
              <label for="option2">Section B</label>
            </div>
          </div>
         
        
      </div>
    </div>
  </div>
  <div class="card crd" >
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed bl-5" type="button" data-toggle="collapse" data-target="#collapsef" aria-expanded="false" aria-controls="collapsef">
          Groupe:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>
    <div id="collapsef" class="collapse show" aria-labelledby="heading" >
      <div class="" id="grpform">
        
          <div class="row justify-content-center">
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp1">
              <input id="option4" name="grp" value="1" checked type="checkbox" />
              <label for="option4">Groupe 1</label>
            </div>
            
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp2">
              <input id="option5" name="grp" value="2" type="checkbox" />
              <label for="option5">Groupe 2</label>
            </div>
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp3">
              <input id="option6" name="grp" value="3" type="checkbox" />
              <label for="option6">Groupe 3</label>
            </div>
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp4">
              <input id="option7" name="grp" value="4" type="checkbox" />
              <label for="option7">Groupe 4</label>
            </div>
            
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp5">
              <input id="option8" name="grp" value="5" type="checkbox" />
              <label for="option8">Groupe 5</label>
            </div>
            <div class="inputGroup  col-md-6 col-lg-4 col-sm-12" id="gp6">
              <input id="option9" name="grp" value="6" type="checkbox" />
              <label for="option9">Groupe 6</label>
            </div>
          </div>
         
        
      </div>
    </div>
  </div>
  
   <div class="card crd" >
    <div class="card-header" id="">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed bl-6" type="button" data-toggle="collapse" data-target="#collapsefi" aria-expanded="false" aria-controls="collapsefi"  data-placement="top" title="ajouter un fichier">
          Fichier:<img src="img/up.png" class="pl-2">
        </button>
      </h5>
    </div>
    <div id="collapsefi" class="collapse show" aria-labelledby="heading" data-parent="#accordionExample">
      <div class="card-body">
        
          <div class="custom-file" id="importPfForm">
              <input type="file" accept=".docx,.xlsx,.pdf" class="custom-file-input" id="customFile" required>
              <label class="custom-file-label" for="validatedCustomFile">Choisi un fichier</label>
              <div class="invalid-feedback">Example invalid !</div>
            </div>
        
      </div>
    </div>
  </div>
  <div class="card crd" >
               <div class="card-header" id="">
                 <h5 class="mb-0">
                   <button class="btn btn-link collapsed bl-9" type="button" data-toggle="collapse" data-target="#collapsefif" aria-expanded="false" aria-controls="collapsefif" >
                     Descreption:<img src="img/up.png" class="pl-2">
                   </button>
                 </h5>
               </div>
               <div id="collapsefif" class="collapse show" aria-labelledby="heading" >
                 <div class="card-body">
                   
                     <div class="form-group">
                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                       </div>
                   
                 </div>
               </div>
             </div>
  <div class="card crd" >
    
    <div id="collapsefia" class="collapse show" aria-labelledby="heading" >
      <div class="row">
         <button class="button btn_env" id="but_ani" type="submit" >Envoyer</button>
      </div>
    </div>
  </div>
</div>
</form>


<script type="text/javascript">

  $( "#affichage" ).submit(function( event ) {
    event.preventDefault();
    if (Getgrps()==null) {
      //document.getElementById('ErrorFile').style.display="block";
      ani2();
     // $( "<div class="row"><p><br>Test</p></div>" ).insertAfter( ".btn_env" );
          
    
    } 
    else {
      var name = document.getElementById("customFile").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['pdf','png','jpg','jpeg','docx','xlsx']) == -1) 
    {
      ani2();
      //$("#ErrorFile").show();
     return;
    }

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("customFile").files[0]);
    var f = document.getElementById("customFile").files[0];
    var fsize = f.size||f.fileSize; //files size in bytes
    if(fsize > 10000000)
    {
      ani2();
     //$("#ErrorImg").show();
    }else{
      // ajax
       var grp=Getgrps();
       
      for(var i=0;i<grp.length;i++){
        form_data.append("submit", 1);
      form_data.append("Page", "publier");
      form_data.append("annee", getAnnee());
      form_data.append("spec", getSpec());
      form_data.append("mod", getModul());
      form_data.append("sec", getSec());
      form_data.append("grp", grp[i]);
      form_data.append("des",$("#exampleFormControlTextarea1").val() );
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

       },   
       success:function(data)
       {
        if(data === "inserted"){
          
          ani1();
        }else{
          ani2();
        }
       }
      });
			  }
      

    }
    }
    

    
  });
</script>
 
