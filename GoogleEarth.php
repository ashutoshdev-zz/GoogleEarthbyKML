<html>
<head>
   <title>fetchkml_dom_example.html</title>
   <?php
         $dir='kml/';
         $files= array_diff(scandir($dir),array('..','.'));
        
         $server=$_SERVER['SERVER_NAME'];
   ?>
   <script src="//www.google.com/jsapi?key=ABQIAAAA5El50zA4PeDTEMlv-sXFfRSsTL4WIgxhMZ0ZK_kHjwHeQuOD4xTdBhxbkZWuzyYTVeclkwYHpb17ZQ"></script>
   <script type="text/javascript">
      var ge;
      var placemark;
      var kmlObject;

      google.load("earth", "1", {"other_params":"sensor=false"});

      function init() {
         google.earth.createInstance('map3d', initCB, failureCB);
      }

      function initCB(instance) {
         ge = instance;
         ge.getWindow().setVisibility(true);

         var href = 'http://<?php echo $server; ?>/'
                      + 'GoogleEarth/kml/<?php echo $files[2]; ?>';

         google.earth.fetchKml(ge, href, kmlFinishedLoading);

         placemark = ge.createPlacemark('');
         var point = ge.createPoint('');
         point.setLatLng(37.803521, -122.450274);
         placemark.setName('Placemark from Earth API');
         placemark.setGeometry(point);
      }

      function kmlFinishedLoading(obj) {
         kmlObject = obj;
         if (kmlObject) {
            if ('getFeatures' in kmlObject) {
               kmlObject.getFeatures().appendChild(placemark);
            }
            ge.getFeatures().appendChild(kmlObject);
            if (kmlObject.getAbstractView())
               ge.getView().setAbstractView(kmlObject.getAbstractView());
         }
         
      }

      function showHideKml() {
         kmlObject.setVisibility(!kmlObject.getVisibility());
      }

      function failureCB(errorCode) {
      }

      google.setOnLoadCallback(init);
   </script>

</head>
<body>

   <div id="map3d" style="border: 1px solid silver; height: 400px; width: 600px;"></div>
 </body>
</html>
