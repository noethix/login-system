<!DOCTYPE html>
<html lang="en">
<head>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="empl.css">
</head>

<body>
    <h1>Employee Database</h1>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Firstname</th>
                <th>Position</th>
                <th>Department</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>Employed</th>
                <th>Salary</th>
                <th>Bonus</th>
                <th>Children</th>
                <th>Xmas Bonus</th>
                <th>Hols Check</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Firstname</th>
                <th>Position</th>
                <th>Department</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>Employed</th>  
                <th>Salary</th>
                <th>Bonus</th>
                <th>Children</th>
                <th>Xmas Bonus</th>
                <th>Hols Check</th>
            </tr>
        </tfoot>
    </table>
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "ajax": {
                "url": 'http://localhost/empl/empl.php',
                "dataSrc": function ( json ) {
                
                    var employes=new Array();
                      for ( var i=0, ien=json.length ; i<ien ; i++ ) {
                        employes[i]=new Array();
                        employes[i][0] = json[i].nom;
                        employes[i][1] = json[i].prenom;
                        employes[i][2] = json[i].poste;
                        employes[i][3] = json[i].service;
                        employes[i][4] = json[i].agence.nomAgence;
                        employes[i][5] = json[i].dateEmb;
                        employes[i][6] = json[i].yearsEmpl+" years";
                        employes[i][7] = json[i].salaire;
                        employes[i][8] = json[i].bonus;
                        if (json[i].enfant.length>0) {
                            var enfants=new Array();
                            for ( var j=0, jen=json[i].enfant.length ; j<jen ; j++ ) {
                                enfants.push(json[i].enfant[j].prenomEnf);
                            }
                            employes[i][9]=enfants.join();
                        } else {
                            employes[i][9]=null;
                        }
                        if (json[i].enfant.length>0) {
                            var enfants=new Array();
                            for ( var j=0, jen=json[i].enfant.length ; j<jen ; j++ ) {
                                enfants.push(json[i].enfant[j].xmasB);
                            }
                            employes[i][10]=enfants.join();
                        } else {
                            employes[i][10]=null;
                        }
                        employes[i][11] = json[i].hols;
                      }
                      return employes;
                        
                    }
            }
        });
        
    } );
    </script>

</body>
</html>