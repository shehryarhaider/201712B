<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
</head>
<?php
    $connect = mysqli_connect("localhost","root","","temp");
    $countries = mysqli_query($connect,"select * from countries");
    $cities = mysqli_query($connect,"select * from cities");
    $fetch_city = mysqli_fetch_all($cities);
?>
<body>
    <h1>Cacading DropDown in PHP</h1>
    <select name="country_id" id="country">
        <option value="" disabled selected>Select Country </option>
        <?php
            while($fetch_country = mysqli_fetch_array($countries))
            {
                echo "<option value='".$fetch_country['id']."'>".$fetch_country['name']."</option>";
            }
        
        ?>
    </select>
    <br><br>
    <select name="cities" id="city">
            <option value="" disabled selected>Select City</option>
    </select>
<script>
    $(document).ready(function(){
        $(document).on('change','#country',function(){
            
            $('#city').empty();
            $('#city').append(`
                        <option disabled selected>Select City</option>
                    `);
                    
            var country_id = $(this).val();

            var cities = <?php echo json_encode($fetch_city);?>;

            $(cities).each(function(index,val){
                
                if(country_id == val[1])
                {
                    $('#city').append(`
                        <option value="${val[0]}">${val[2]}</option>
                    `);
                }

            }); 
        });
    }); 
</script>
</body>
</html>