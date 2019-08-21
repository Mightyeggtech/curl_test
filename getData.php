<html>
<head>

<?php 
$q = "{'15'.EX.'IT'}OR{'15'.EX.'Support'}OR{'15'.EX.'Billing'}";
$url = "https://builderprogram-meff.quickbase.com/db/bptu26yq5?a=API_DoQuery&query=(".$q.")&clist=11.15.5&usertoken=b4ttby_na3y_dcazzchdsqxs4pc22uifhc6v34b2";
?>

<script lang="javascript" src="https://builderprogram-meff.quickbase.com/db/bptu26yq5?a=API_DoQuery&query=({'15'.EX.'IT'}OR{'15'.EX.'Support'}OR{'15'.EX.'Billing'})&clist=11.15.5&usertoken=b4ttby_na3y_dcazzchdsqxs4pc22uifhc6v34b2">
</script>
<style>
   td.m { font-family:verdana; font-size:70%; }
   td.hd { font-family:verdana; font-size:70%; font-weight:bold;
    color:white;}
</style>
</head>
<body>
<h1>Example</h1>
   <table cellpadding=5 bgcolor=lightgreen>
      <tr>
         <td valign=top nowrap><b>A Quick Base table<br>embedded in
            a<br>page of HTML
         </td>
         <td>
            <script lang="javascript">
               qdbWrite();
            </script>
         </td>
      </tr>
   </table>
</body>
</head>
</html>