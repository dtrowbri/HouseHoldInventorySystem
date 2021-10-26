<?php
//echo "<pre>" . print_r($results, true) . "</pre>"; //for testing purposes.
echo "
    <div class='container mt-3'>
        <a class='btn btn-sm btn-outline-primary btn-block mb-2' type='button' href='ItemNew.php'>New Item</a>";
if( $results == NULL ) {
    echo "<div class='container mt-3'><h1>No results found.</h1></div>";
} else {
    echo "
        <table id='products' class='table table-striped table-hover table-sm align-middle table-responsive-lg'>
            <thead>
                <tr>
                    <th class='text-center' scope='col'> Item ID </th>
                    <th scope='col'> Name </th>
                    <th scope='col'> Description </th>
                    <th scope='col'> Quantity </th>
                    <th class='text-center' scope='col'></th>
                    <th class='text-center' scope='col'></th>
                </tr>
            </thead>
            <tbody>
";
    for($x=0; $x < count($results); $x++) {
        echo "
                <tr>
                    <td class='text-center'>" . $results[$x]->getId() . "</td>
                    <td>" . $results[$x]->getName(). "</td>
                    <td> " . $results[$x]->getDescription() . "</td>
                    <td>" . $results[$x]->getQuantity() . "</td>
                    <td class='text-center'>
                        <form class='d-flex' style='margin-bottom:0' action='ItemEdit.php' method='POST'>
                            <button class='btn' name='ItemEdit' id='ItemEdit' value='" . $results[$x]->getId() . "'>Edit</button>
                        </form>
                    </td>
                    <td class='text-center'>
                        <form class='d-flex' style='margin-bottom:0' action='ItemDel.php' method='POST'>
                            <button class='btn' name='ItemDel' id='ItemDel' onclick='return ConfirmDelete()' value='" . $results[$x]->getId() . "'>Del</button>
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