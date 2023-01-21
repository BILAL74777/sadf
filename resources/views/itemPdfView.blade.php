<!DOCTYPE html>
<html>
<head>
    <title>CRM Certificate</title>  
</head>
<style type="text/css"> 
    body{
        background-image: url('images/logo.png');
        opacity: 0.2;
    }
    table{
        background-image:url('https://www.timeoutdubai.com/attraction/img-worlds-of-adventure');
        width: 100%;
        border-collapse: collapse;
    } 
    table td, table th{  
        border:1px solid black;
    } 
    table tr, table td{
        padding: 5px;
    } 
</style>
<body>
    
    {{-- <img src="asset('images/logo.png')" height="60" alt="logo" /> --}}
    <div class="container">  
    <br/>  
    {{-- <a href="{{ route('pdf',['download'=>'pdf']) }}">Download PDF</a>      --}}
    
    <table>  
        <caption> <h4>CRM PDF Certificate</h4> </caption>
        <tr>
                   
            <th scope="col">Company</th>
             <td>{{ $trainings->company }}</td>
             <th scope="col">Date</th>
             <td>
              {{ $trainings->date }}
            </td>

            </tr>
            <tr>
                <th scope="col">City</th>
                <td>{{ $trainings->city }}</td>

                <th scope="col">Country</th>
                <td>{{ $trainings->country }}</td>

            </tr>
            <tr>
                 <th scope="col">Assigned Trainer</th>
                 <td>{{ $trainings->assigned_trainer }}</td>
                  <th scope="col">Certificates</th>
                  <td>{{ $trainings->certificates }}</td>

            </tr>
            <tr>
                 
                <th scope="col">Status</th>
                <td>{{ $trainings->status }}</td>
                <th scope="col"></th>
                <td></td>

            </tr>
            
          
    </table>  
</div>  
</body>
</html>
 