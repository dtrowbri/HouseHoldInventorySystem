<?php
//echo "<pre>" . print_r($results, true) . "</pre>"; //for testing purposes.
echo "
    <div class='container mt-3'>
        <a class='btn btn-sm btn-outline-primary btn-block mb-2' type='button' href='HHNew.php'>New Household</a>";
if( $results == NULL ) {
    echo "<div class='container mt-3'><h1>No results found.</h1></div>";
} else {
    echo "
        <table id='products' class='table table-striped table-hover table-sm align-middle table-responsive-lg'>
            <thead>
                <tr>
                    <th class='text-center' scope='col'> Household ID </th>
                    <th scope='col'> Name </th>
                    <th scope='col'> Address </th>
                    <th scope='col'> User ID </th>
                    <th class='text-center' scope='col'></th>
                    <th class='text-center' scope='col'></th>
                </tr>
            </thead>
            <tbody>
";
    for($x=0; $x < count($results); $x++) {
        echo "
                <tr>
                    <td class='text-center'>" . $results[$x][Id] . "</td>
                    <td>" . $results[$x][Name] . "</td>
                    <td> " . $results[$x][Address] . "</td>
                    <td>" . $results[$x][UserId] . "</td>
                    <td class='text-center'>
                        <form class='d-flex' style='margin-bottom:0' action='HHEdit.php' method='POST'>
                            <button class='btn' name='HHEdit' id='HHEdit' value='" . $results[$x][Id] . "'>Edit</button>
                        </form>
                    </td>
                    <td class='text-center'>
                        <form class='d-flex' style='margin-bottom:0' action='HHHandler.php' method='POST'>
                            <button class='btn' name='HHDel' id='HHDel' onclick='return ConfirmDelete()' value='" . $results[$x][Id] . "'>Del</button>
                        </form>
                    </td>
                </tr>
";
    }
}
echo "
            </tbody>
        </table>
    </div>
    <link href='css/dataTables.bootstrap5.min.css' rel='stylesheet'/>
    <script src='js/jquery-3.5.1.js'></script>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap5.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#products').DataTable({lengthChange: false, lengthMenu: [ 10 ]});
        });
    </script>
    <script>
        function ConfirmDelete()
        {
            return confirm('Are you sure you want to delete?');
        };
    </script>
";
?>