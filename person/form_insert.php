<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
    echo "account : ".$_SESSION['user_id'];
    if($_SESSION['user_id']!='admin'){    
        ?>
<script>alert("no access right");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
<?php
    }
        
?>
<?php

    echo $_SESSION['user_id'];
    include_once("../header.php");
            include_once ("../form_search.html");
?>
<?php

            $asset_id = $_POST['asset_id'];
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select dept_id, dept_name from dbo.Department";
            $result = mssql_query($sql,$conn);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type = "text/javascript">
               function isNull(text){
                      if(text===null||text===""){
                          return true;
                      }
                      else{
                          return false;
                      }
                  }
              function chk(){

                  var name= document.getElementById("p_name").value;     
                  var loc = document.getElementById("dept_name").value;
                 
                  if(isNull(loc)||isNull(name)){
                      alert("invalid input");
                      return false;
                  }
                  return true;
                  
                  
                  
              }
              
                
            
            
       
        </script>
    </head>
    <body>
        <form method ="post"  action ='do_insert.php' onsubmit='return chk()'>
             <div>
                 name : <input type ="text" name ="p_name" id = 'p_name'>
             </div>
            <div>
                apellido : <input type="text" name ="p_firstname" id ="p_firstname">
                
            </div>
            
             <div>
                      department :       <select name ='dept_name' id = 'dept_name'>
                 <?php
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['dept_name']?>'> <?php echo $row['dept_name']?></option>
                 <?php
                 }
                 
                 ?>
             </select>
                 
             </div>
             <div>
                 <input type="submit" name ="submit" value = "insert">
                 
            </div>
            
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
        
    </body>
</html>
