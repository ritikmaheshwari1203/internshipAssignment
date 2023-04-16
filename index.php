<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  <div class="container" id="loader" style="display: none;">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Data Enterd successfully!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  </div>

  <div class="container mt-4" id="render">
  
  <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">City</label>
    <input type="text" class="form-control" id="city">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="number">
  </div>
  <button type="button" class="btn btn-primary" onclick="Submit()">Submit</button>
</form>
  </div>

<script>
    function Submit(){
        let name=document.getElementById('name')
        let city=document.getElementById('city')
        let number=document.getElementById('number')
        if(name.value==''||city.value==''||number.value=='')
        console.log("hello");
        else{
            data={
                'name':name.value,
                'city':city.value,
                'number':number.value
            }

            const jsondata=JSON.stringify(data)
            obj={
            method:'post',
            header:{
                'Content-Type' : 'application/json'
            },
            body:jsondata
        }

        fetch("php/login.php",obj).then(function(response){
            return response.json()
        }).then(function(data){
          let loader=document.getElementById('loader')
          loader.style.display="block"
            let render=document.getElementById('render')

            render.innerHTML=`<button type="button"><a href="php/data/${data['id']}.pdf">Download Your Data</a></button>`
        })
        }
    }

    // function Download(){

    //   fetch('php/pdf.php').then(function(response){
    //     return response.json()
    //   }).then(function(data){

    //     location.href=`php/data/${data['id']}`
    //   })
    //   console.log("download");
    // }
</script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>