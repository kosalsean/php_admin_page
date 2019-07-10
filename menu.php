<?php
 $connecton = new mysqli('localhost', 'root', '', 'rean_web');
 $sql = "SELECT *FROM tbl_menu ORDER BY id DESC ";
 $result = $connecton->query($sql);
 $num = $result->num_rows;
 if($num==0){
     $lastID = 1;
 }
 $row = $result->fetch_array();
 $lastID = $row[0] +1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.js" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"> -->
    <!-- <link href="all.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <body>
        <div class="box">
            <form class="upl">
                <input type="hidden" name="txt-edit-id" value="0" id="txt-edit-id">
                <label for="txt-id">ID</label>
                <input class="input-cntr" type="text" name="txt-id" id="txt-id" value="<?php echo $lastID;  ?>"
                    readonly>
                <label for="txt-name">Name</label>
                <input class="input-cntr" type="text" id="txt-name" name="txt-name" autocomplete="off">
                <label for="txt-color">Color</label>
                <select class="input-cntr" name="txt-color" id="txt-color">
                    <option value="red">red</option>
                    <option value="green">green</option>
                    <option value="blue">blue</option>
                </select>
                <label for="txt-img">Photo</label>
                <div class="img-box">
                    <input type="file" name="txt-file" id="txt-file">
                </div>
                <input type="hidden" id="img-name" name="txt-photo">
                <div class="btn-post" id="btn-post" name="btn-post">POST</div>
            </form>
        </div>
        </div>
        <!-- //!-------------------------------
    //!------------------------------------------->
        <table class="tbl-result">
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>COLOR</th>
                <th class="img-row">PHOTO</th>
                <th>EDIT</th>
            </tr>
            <?php
            $sql = "SELECT *FROM tbl_menu ";
            $result = $connecton->query($sql);
            if($num>0){
                while ($row = $result->fetch_array() ) {
            ?>
            <tr class="tbl1-result alternate-row">
                <td><?php echo $row[0];  ?></td>
                <td><?php echo $row[1];  ?></td>
                <td><?php echo $row[2];  ?></td>
                <td class="img-row ">
                    <img class="row-img" src="<?php echo $row[3]; ?>" alt="image">
                    <!-- <input type="text" class="img-name" value="<?php  echo $row[3]  ?>"> -->
                </td>
                <td>
                    <div class="btn-edit">Edit</div>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
        <script src="script.js"></script>
    </body>
</body>

</html>