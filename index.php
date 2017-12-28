<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Barcode Scanner</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
      input{
        margin-top:25px;
        margin-bottom:25px;
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <?php include("favicon.php");?>
    <script>
      var db=[];
      $(document).ready(function(){
        getDB();
        $("#upc").keypress(function(e){
          if(e.which == 13){
            search();
          }
        });

        $("#upc").focus();
        setInterval(function(){$("#upc").focus();},1000);
      });

      function getDB(){
        $.getJSON('data.json',function(data){
          db = data;
        });
      }

      function search(){
        var value =  $("#upc").val().toString();
        $("#upc").val("");
        console.log(value);
        db.forEach(function(i){
          if(i.upc == value){

            $("#itemtitle").html(i.title);
            $("#itemdis").html(i.type);
            if(i.type == "youtube-album"){
              youtube(i.url);
              }else if(i.type == "youtube-video"){
              id=i.url.split("=")[1].split("&")[0];
              console.log("id");
             $("#video").html('<iframe width="560" height="315" src="https://www.youtube.com/embed/'+id+'" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>');
            }else{
              $("#video").html('');
            }

            if(i.url !== undefined ){
              $("#link").html('<a class="btn btn-primary" href="'+i.url+'" target="_blank" role="button">Link</a>');
              }else{
              $("#link").html('');
            }

            if(i.msg !== undefined ){
              $("#msg").html(i.msg);
              }else{
              $("#msg").html('');
            }

          }
        });
      }

      function itemfound(value,title,dis){
      };

      function youtube(url){
        console.log("youtube");
        $("#video").html('');
        $.get("getYT.php?url="+url,function(data){
          var url = data.split('\n')[0];
          $("#video").html('<audio controls autoplay><source src="'+url+'" type="audio/webm"></audio>');
        });
      }
    </script>
  </head>
  <body>

    <div id="main" class="container">
      <div class="row">
        <div class="col-sm-12">
          <input type="number" id="upc" class="form-control"></input>
        </div>
        <!--card start-->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              Results 
            </div>
            <div class="card-block">
              <h4 class="card-title" id="itemtitle"></h4>
              <p class="card-text" id="itemdis"></p>
              <p class="card-text" id="msg"></p>
              <div id="video"></div>
              <div id="link"></div>
            </div>
          </div>
        </div>
        <!--card end-->

      </div>
    </div>

  </body>
</html>

