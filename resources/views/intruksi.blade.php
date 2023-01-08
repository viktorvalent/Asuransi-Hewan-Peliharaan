<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<!--     
    Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="{{asset('css/intruksi.css') }}"> -->
     <!-- <link rel="stylesheet" href="{{asset('js/login.js') }}"> -->
    <link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>
<body>
<div class="container">
  <h1>
  <a target="_blank" href="https://github.com/safrazik/knockout-file-bindings">knockout-file-bindings</a>
  </h1>
<div class="well" data-bind="fileDrag: fileData">
    <div class="form-group row">
        <div class="col-md-6">
            <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
            <div data-bind="ifnot: fileData().dataURL">
                <label class="drag-label">Drag file here</label>
            </div>
        </div>
        <div class="col-md-6">
            <input type="file" data-bind="fileInput: fileData, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
        </div>
    </div>
</div>
  
  <h3>Multiple File Uploads</h3>
<div class="well" data-bind="fileDrag: multiFileData">
    <div class="form-group row">
        <div class="col-md-6">
                  <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                  <img style="height: 100px; margin: 5px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                  <!-- /ko -->
            <div data-bind="ifnot: fileData().dataURL">
                <label class="drag-label">Drag files here</label>
            </div>
        </div>
        <div class="col-md-6">
            <input type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
        </div>
    </div>
</div>
  <button class="btn btn-default" data-bind="click: debug">Debug</button>
</div>
</body>



<style>
.container {
  max-width: 750px;
  padding: 15px;
}
</style>

 
  <script>
$(function(){
  var viewModel = {};
  viewModel.fileData = ko.observable({
    dataURL: ko.observable(),
    // base64String: ko.observable(),
  });
  viewModel.multiFileData = ko.observable({
    dataURLArray: ko.observableArray(),
  });
  viewModel.onClear = function(fileData){
    if(confirm('Are you sure?')){
      fileData.clear && fileData.clear();
    }                            
  };
  viewModel.debug = function(){
    window.viewModel = viewModel;
    console.log(ko.toJSON(viewModel));
    debugger; 
  };
  ko.applyBindings(viewModel);
});
  </script>
  
</html>