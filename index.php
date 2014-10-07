<!DOCTYPE HTML>
<html>
    <head>
        <title>GoogleEarth</title>
        <link href="css/style.css" rel="stylesheet"/>
    </head>
    <script type="text/javascript">
    function validation()
    {
        if(document.getElementById('file').value=='')
        {
            alert('Please Upload KML File!');
            return false;
        }
        return true;

    }
    </script>
    <body>
        
        <div class="container">
            <div class="form">
                <fieldset>
                    <form method="post" name="frm" onsubmit="return validation()" enctype="multipart/form-data">
                        Upload KML File:<input type="file" name="file" id="file" value=""/><br/><br/>
                    <input type="submit" name="submit" value="upload"/>
                </form>
                </fieldset>
            </div> 
            <div class="form">
                <fieldset>
                    <a href="GoogleEarth.php" target="_blank">Click To View GoogleEarth</a>
                </fieldset>
            </div> 
        </div>
    </body>
</html>
<?php 
if(isset($_POST['submit']))
{
    $file=$_FILES['file'];
   
    $pathinfo=pathinfo($file['name']);
    if($pathinfo[extension]=='kml')
    {
         $dir='kml/';
         $files= array_diff(scandir($dir),array('..','.'));
         unlink('kml/'.$files[2]);
         $destination='kml/'.$file['name'];
         move_uploaded_file($file['tmp_name'], $destination);
          echo "<script>alert('KML File uploaded  Sucessfully!')</script>";
    }
    else
    {
        echo "<script>alert('Please upload KML File!')</script>";
        echo "<script>window.location='index.php'</script>";
    }
    
}
?>
