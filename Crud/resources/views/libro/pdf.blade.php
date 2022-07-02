<style>
        <style>
        h1{
            color: green;
        }
        table{
            width: 100%;
        }
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
    </style>
                            <table id="customers" class="table table-light">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Categoria Id</th>
										<th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($libros as $libro)
                                        <tr>                                        
                                            <td>{{ $libro->id }}</td>    
											<td>{{ $libro->categoria->nombre }}</td>
											<td>{{ $libro->nombre }}</td>
                                    @endforeach
                                </tbody>
                            </table>
