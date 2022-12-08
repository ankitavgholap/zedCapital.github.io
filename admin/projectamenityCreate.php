<?php session_start();
if(!isset($_SESSION['login']))
{
    header('Location: index.php');
}
include_once('config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $_SESSION['company'] ?> Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC">
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/theme-blue-grey.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
</head>

<body class="theme-blue-grey body-bg">

    <!-- Overlay For Sidebars
    <div class="overlay"></div>
    #END# Overlay For Sidebars -->
    <?php include_once('includes/header.php'); ?>
    <section>
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/rightbar.php'); ?>
        <?php include_once('config.php'); ?>

    <?php
        $sql = "SELECT * FROM `projects`"; 
        $projects = mysqli_query($db,$sql);
        $sqlamenity = "SELECT * FROM `amenities` order by `name` DESC"; 
        $amenities = mysqli_query($db,$sqlamenity);
    ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $_SESSION['company'] ?> Create Project
                                <a href="projectamenities.php" button style="float:right" type="button"
                                    class="btn btn-success btn-sm">
                                    <- Back </button> </a> 
                            </h2> 
                        </div> 
                      
                       <div class="body">
                       
                           <form class="rows" action="projectamenitySubmit.php" method="post" enctype="multipart/form-data">
                                    <?php
                                        
                                        if(isset($_REQUEST['eid']))
                                        {
                                            $eid=$_GET['eid'];
                                            $result=mysqli_query($db,"select * from project_amenities where id=$eid");
                                            $single=mysqli_fetch_array($result);
                                            //print_r($single);
                                        }
                                    ?>

                                <div class="col-md-12">
                                    <label for="status" class="form-label">Select project :</label>
                                    <select class="form-control form-select" name="project" id="project" aria-label="Default select example" required>
                                        <option value="" >Select project</option>
                                        <?php 
                                        foreach($projects as $project) { ?>
                                            <option value="<?php echo $project['id']; ?>" <?php if(isset($single['project_id']) && $project['id'] === $single['project_id'])  { ?> selected <?php } ?> ><?php echo $project['title']?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <?php
                                    foreach($amenities as $amenity)
                                    { 
                                    ?>
                                        <input type="checkbox" name="amenity[]" value="<?php echo $amenity['id']; ?>" <?php if(isset($single['ameniti_id']) && $single['ameniti_id'] === $amenity['id'])  { ?> checked <?php } ?> > <?php echo $amenity['name']?><br>
                                    <?php 
                                    }
                                    ?>
                                </div>

                                <div class="row text-center">
                                  
                                        <?php 
                                        if(isset($single)) 
                                        {
                                        ?>
                                            <input type="hidden" value="<?php echo $single['id'] ?>" name="eid">
                                            <button style="margin-top:20px; margin-bottom:20px;" type="submit"
                                                name="edit" class="btn btn-primary">Edit Project Amenities</button>
                                            <?php 
                                        }
                                        else
                                        { 
                                        ?>
                                            <button style="margin-top:20px; margin-bottom:20px;" type="submit"
                                                name="insert" class="btn btn-success">Create Project Amenities</button>
                                        <?php 
                                        } ?>
                                  
                                </div>
                            </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"></script>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>


    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/date-uk.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#homeDiv').hide();

            $('#example1').DataTable({
                "pageLength": 10,
            });

            $('#show_home').on('click', function () {
                if ($(this).prop('checked')) 
                {
                    $('#homeDiv').show();   
                } 
                else 
                {
                    $('#homeDiv').hide();
                }
            });

        });
    </script>
</body>

</html>