<!DOCTYPE html>
<!--[if IE 8]><html lang="en" id="ie8" class="lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]><html lang="en" id="ie9" class="gt-ie8 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.3.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
    <link rel="stylesheet" href="css/pages/page_log_reg_v1.css" />
    <link rel="stylesheet" href="css/pages/page_log_reg_v2.css" />
    <link rel="stylesheet" href="css/headers/header1.css">
    <script type="text/javascript" src="js/addcsv.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel='stylesheet' id='google-fonts-css'  href='http://fonts.googleapis.com/css?family=Open+Sans%3A600%7CRoboto+Condensed%3A400%2C700&#038;ver=3.9' type='text/css' media='all' />
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico">

</head>
<body>
<div style="position: relative;">
    <div id="divBackgroundArea"></div>
    <div class="container" style="padding-top:30px;">
        <p id="headerBreadcrum">
            Add CSV FILE
        </p>
        <hr style="border-top: 1px solid #999;">
        <h1 id="headerTitle">Add CSV FILE</h1>
    </div>

    <div class="container" style="margin-top:40px; min-height: 600px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-black1 margin-bottom-40" style="box-shadow: 0px 0px 10px #777;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-plus"></i> Save CSV FILE</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div id="photoList">
                                <div class="form-group" id="photoItem">
                                    <label class="col-lg-2 control-label">CSV FILE</label>
                                    <div class="col-lg-10">
                                        <form id="imageForm" method="post" enctype="multipart/form-data" action='async-uploadcsv.php' style="margin-bottom:0px;">
                                            <input type="file" name="imageUpload" id="imageUpload" class="form-control" style="width: 75%;float:left;"/>
                                            <input type="hidden" name="uploadType" value="csv">
                                            <input type="hidden" id="imagePrevDiv" value="previewImage">
                                            <div id="previewImage" class="previewImage floatleft">
                                                <img src="<?php ?>" style="width:100%;"/>
                                            </div>
                                            <div class="clearboth"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="col-lg-2 col-lg-offset-4">
                                        <button class="btn-u btn-u-blue btn-block" onclick="onAddCSV( )"><i class="icon-plus"></i> Add CSV</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>